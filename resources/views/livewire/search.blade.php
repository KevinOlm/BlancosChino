<div>
    <div class="searchField">
        <a href="{{route('products', 'search=' . $searchValue)}}" class="searchButton">
            Buscar
        </a>
        <input 
            type="text" 
            name="productSearch" 
            id="productSearch" 
            placeholder="Escriba lo que desee buscar"
            wire:model="searchValue">
    </div>
    @if (count($matchedProducts))
        @foreach ($matchedProducts as $matchedProduct)
            <a class="matchedProduct productLink" href="{{route('product-overview', $matchedProduct)}}">
                <div class="matchedProductImage">
                    <img 
                        class="fixedImage"
                        src="{{asset('storage/' . $matchedProduct->product->images[0]->image)}}"
                        alt="{{$matchedProduct->product->images[0]->alt}}">
                </div>
                <div class="productInfo">
                    <p class="name">{{$matchedProduct->name}}</p>
                    <span class="price">${{$matchedProduct->price}}mxn</span>
                    @if ($matchedProduct->offerActive)
                        <span class="oldPrice">${{$matchedProduct->oldPrice}}mxn</span>
                    @endif
                </div>
            </a>
        @endforeach
    @else
        @if ($searchValue)
            <div class="matchedProduct">
                <div class="productInfo">
                    <p class="name">Producto no encontrado</p>
                </div>
            </div>
        @endif
    @endif
</div>
