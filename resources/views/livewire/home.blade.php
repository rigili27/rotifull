<div>
    @foreach ($families as $family)
        {{-- <h2>{{ $family->name }}</h2> --}}

        @foreach ($categories as $category)
            <h3>{{ $category->name }}</h3>

            <ul>
                @foreach ($products->where('family_id', $family->id)->where('category_id', $category->id) as $product)
                    <li class="border p-2 rounded flex items-center space-x-2">
                        <div class="w-1/5">
                            <div class="aspect-square overflow-hidden rounded">
                                <img src="{{ asset('storage') }}/{{ $product->image_url }}" class="object-cover w-full h-full">
                            </div>
                        </div>
                        <div class="w-3/5 flex flex-col justify-between">
                            <strong>{{ $product->name }}</strong>
                            <span class="text-sm text-gray-500 mb-2">$ {{ $product->price }}</span>
                        </div>
                        <button wire:click="addToCart({{ $product->id }})" class="text-sm bg-blue-500 text-white px-2 py-1 rounded w-fit">
                            Agregar
                        </button>
                    </li>
                @endforeach
            </ul>
        @endforeach
    @endforeach


    <!-- Botón flotante para abrir el modal -->
    <button wire:click="$set('showCart', true)" class="fixed bottom-4 right-4 bg-green-600 text-white p-4 rounded-full shadow-lg z-50">
        🛒
    </button>


    <!-- Modal del carrito -->
    @if ($showCart)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-40" wire:click.self="$set('showCart', false)">
            <div class="bg-white w-full max-w-md p-4 rounded shadow-lg relative">
                <button wire:click="$set('showCart', false)" class="absolute top-2 right-2 text-gray-600 hover:text-black">
                    ✖
                </button>

                <h2 class="text-xl font-bold mb-4">Tu carrito</h2>
                <livewire:cart />
            </div>
        </div>
    @endif



    {{-- otro home --}}

    <div class="mx-3">
        @foreach ($families as $family)
            {{-- <h2>{{ $family->name }}</h2> --}}

            @foreach ($categories as $category)
                <h3>{{ $category->name }}</h3>

                <div class="my-2"></div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($products->where('family_id', $family->id)->where('category_id', $category->id) as $product)
                        <div class="rounded-lg shadow-md py-4">
                            <div class="overflow-hidden justify-items-center">
                                <img src="{{ asset('storage') }}/{{ $product->image_url }}" class="rounded-full object-cover w-20 h-20">
                            </div>
                            <p class="w-full text-xs text-center font-medium mt-2">{{ $product->name }}</p>
                            <p class="w-full text-xs text-center font-extralight">{{ $product->description }}</p>
                            <p class="w-full text-sm text-center font-medium mt-2">$ {{ $product->price }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>

</div>
