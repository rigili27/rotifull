<?php

namespace App\Livewire;

use App\Models\Product;
use Filament\Notifications\Notification;
use Livewire\Component;

class Home extends Component
{

    public $families;
    public $categories;
    public $products;

    public $showCart = false;


    public function mount()
    {
        $this->families = \App\Models\Family::orderBy('position')->get();
        $this->categories = \App\Models\Category::orderBy('position')->get();
        $this->products = \App\Models\Product::orderBy('position')->get();
    }



    public function render()
    {

        return view('livewire.home');
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_url,
                'quantity' => 1
            ];
        }

        Notification::make()
        ->title('Carrito actualizado')
        ->body('Se agrego ' . $product->name . 'al carrito.')
        ->success()
        ->send();

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated')->to(\App\Livewire\Cart::class);
    }
}
