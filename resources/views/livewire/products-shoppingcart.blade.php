<div wire:init="pageLoaded">
    <div class="productsContentContainer">
        <div class="cartButtons">
            <p class="total">Total: ${{number_format($total, 2)}}mxn</p>
            @auth
                <div class="purchaseButton" wire:click="purchase">Comprar</div>
            @else
                <a href="{{route('login')}}" class="purchaseButton">Inicia sesión para comprar</a>
            @endauth
            <div class="cleanCartButton" wire:click="cleanCart">Limpiar carrito</div>
            <p class="total chargingText" wire:loading.inline>Cargando...</p>
        </div>

        <div class="productsContainer">
            @if (count($cartProducts))
                @foreach ($cartProducts as $item)
                    @livewire('product-shoppingcart', ['item' => $item], key($item->id))
                @endforeach
            @else
                @if ($loaded)
                    <div class="noProducts">
                        <h2 class="noProductsTitle">No hay productos en tu carrito, 
                            <a class="noProductsLink" href="{{route('products')}}">has click aqui para agregar</a>
                        </h2>
                    </div>
                @else
                    <div class="noProducts"><p>Cargando productos</p></div>
                @endif
            @endif
        </div>
    </div>
</div>
