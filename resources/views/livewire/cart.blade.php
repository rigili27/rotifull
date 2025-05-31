<div class="space-y-3">

    @forelse ($cart as $productId => $item)
        <div class="flex justify-between items-center border p-2 rounded">
            <div>
                <strong>{{ $item['name'] }}</strong><br>
                <span class="text-sm text-gray-500">Cantidad: {{ $item['quantity'] }}</span><br>
                <span class="text-sm text-gray-500">Precio: ${{ $item['price'] }}</span>
            </div>
            <button wire:click="removeFromCart({{ $productId }})" class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                Quitar
            </button>
        </div>

    @empty
        <p class="text-gray-500">Tu carrito está vacío.</p>
    @endforelse


    @if ($cart)
        <div class="flex items-center space-x-2">
            <input type="checkbox" wire:click="Delivery" wire:model="withDelivery" id="withDelivery" class="form-checkbox">
            <label for="withDelivery">Enviar pedido (+$1000)</label>
        </div>

        {{-- <input wire:model="withDelivery"> --}}
        @if ($withDelivery)
            <div>
                <label for="deliveryAddress" class="block text-sm font-medium text-gray-700">Dirección de envío:</label>
                <input type="text" id="deliveryAddress" wire:model.live="deliveryAddress" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ej: San Martín 123">
            </div>
            {{-- <input wire:model="deliveryAddress"> --}}
        @endif


        <div class="text-right font-semibold text-lg">
            Total: ${{ $this->total }}
        </div>

        <a href="https://wa.me/5493385461765?text={{ $this->whatsappMessage }}" target="_blank" class="block bg-green-500 text-white text-center py-2 rounded">
            Enviar pedido por WhatsApp
        </a>
    @endif
</div>
