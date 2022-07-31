<div class="productOverview">
    <x-product-contact-background>
        <x-slot name="graphic">
            <div class="imageSelectionContainer">
                @for ($i = 0; $i < count($product->product->images); $i++)
                    <input 
                        type="radio" 
                        name="selectedImage" 
                        value="{{$i}}" 
                        wire:model="selectedImage" 
                        {{($i === 0)? 'checked': ''}}
                        id="selectedImage{{$i}}">
                    <label class="minImageContainer" for="selectedImage{{$i}}">
                        <img 
                            src="{{asset('storage/' . $product->product->images[$i]->image)}}" 
                            alt="{{$product->product->images[$i]->alt}}"
                            class="image imgHorizontal">
                    </label>
                @endfor
            </div>
            <div class="imageContainer">
                <img 
                    src="{{asset('storage/' . $product->product->images[$selectedImage]->image)}}" 
                    alt="{{$product->product->images[$selectedImage]->alt}}"
                    class="image imgHorizontal"
                    id="imageOverview">
            </div>
        </x-slot>
        <div class="text">
            <h2>{{$product->name}}</h2>
            <div class="rateIcons">
                <p>
                    {{number_format(round($product->product->calification, 1), 1)}} 
                    de {{$product->product->calificationNumber}} usuarios</p>
                @for ($i = 0; $i < round($product->product->calification); $i++)
                    <i class="fas fa-star rateIcon"></i>
                @endfor
                @for ($i = round($product->product->calification); $i < 5; $i++)
                    <i class="far fa-star rateIcon"></i>
                @endfor
            </div>
            <p class="description">{{$product->description}}</p>
            <div class="prices">
                @if ($product->offerActive)
                    <p class="oldPrice">${{number_format($product->oldPrice, 2)}}mxn</p>
                @endif
                <p class="price">${{number_format($product->price, 2)}}mxn</p>
            </div>
            <span class="stock">Stock: {{$product->stock}} piezas</span>
        </div>
        <div class="buttons">
            <div class="variations">
                <div class="sizeVariation">
                    <select name="category" id="selectCategory" wire:model="actualSize">
                        @foreach ($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size}}</option>
                        @endforeach
                    </select>
                </div>
                @if ($product->stock > 0)
                    <div class="quantityVariation">
                        <input type="number" min="1" name="number" placeholder="Cantidad: 1" wire:model="quantity">
                    </div>
                @endif
            </div>
            <div class="purchaseButtons">
                @if ($product->stock > 0)
                    <div
                        id="addToCartButton"
                        class="addToCart"
                        wire:click="store"
                        wire:loading.remove
                        wire:target="store, purchase, purchaseConfirmation">
                        <span class="buttonText">Agregar al carrito</span>
                    </div>
                    @auth
                        <div
                            id="purchaseNowButton"
                            wire:click="purchase"
                            class="purchaseNow"
                            wire:loading.remove
                            wire:target="store, purchase, purchaseConfirmation">
                            <span class="buttonText">Comprar ahora</span>
                        </div>
                    @else
                        <a
                            href="{{route('login')}}"
                            class="purchaseNow"
                            wire:loading.remove
                            wire:target="store">
                            <span class="buttonText">Inicia sesión para comprar</span>
                        </a>
                    @endauth
                    <div
                        class="outOfStock"
                        id="loadingPurchase"
                        wire:loading.flex
                        wire:target="store, purchase, purchaseConfirmation">
                        <span class="buttonText">Cargando</span>
                    </div>
                @else
                    <div class="outOfStock"><span class="buttonText">Producto fuera de stock</span></div>
                @endif
            </div>
        </div>
    </x-product-contact-background>
</div>
