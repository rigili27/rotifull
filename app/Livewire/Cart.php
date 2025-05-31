<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Notifications\Notification;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public $withDelivery = false;
    public $deliveryAddress = '';


    public function Delivery()
    {
        $this->loadCart();
    }

    public function getTotalProperty()
    {

        $total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($this->withDelivery) {
            $total += 1000;
        }

        return $total;
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->cart = [];
    }


    public function mount()
    {
        $this->loadCart();
        // $this->deliveryAddress = ''; // ← Asegura que exista desde el principio
    }

    public function loadCart()
    {


        $this->cart = session()->get('cart', []);
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        // Obtener nombre antes de eliminar
        $productName = $cart[$productId]['name'] ?? 'el producto';

        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->loadCart();

        Notification::make()
            ->title('Carrito actualizado')
            ->body("Se quitó $productName del carrito.")
            ->success()
            ->send();
    }


    public function render()
    {
        return view('livewire.cart');
    }

    public function getWhatsappMessageProperty()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return '';

        $salto = "\n";

        $message = "Hola Rotifull 👋🏼 quiero hacer este pedido:";

        $message .= $salto . $salto;

        foreach ($this->cart as $item) {
            $message .= "- {$item['quantity']} x *{$item['name']}*  ($" . $item['price'] * $item['quantity'] . ")";
            $message .= $salto;
        }

        $message .= $salto;

        $total = collect($this->cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        if ($this->withDelivery) {
            $message .= "🛵 *Envío: $1000*" . $salto;
            $message .= "📍 Dirección: " . $this->deliveryAddress . $salto;
            $total += 1000;
        }

        $message .= $salto . "*Total: $" . $total . "*";

        return urlencode($message); // <- codifica todo correctamente para WhatsApp
    }
}
