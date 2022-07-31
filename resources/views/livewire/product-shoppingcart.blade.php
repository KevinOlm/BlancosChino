@if ($renderedItem)
    <div class="product">
        <div class="imageContainer">
            <a href="{{route('product-overview', $renderedItem->product)}}">
                <span>
                    {{($renderedItem->product->size->size === 'Sin tamaño')? 
                    'Único tamaño' : $renderedItem->product->size->size}}
                </span>
                <div class="blurry"></div>
                <img 
                    class="imgage imgHorizontal"
                    src="{{asset('storage/' . $renderedItem->product->product->images[0]->image)}}" 
                    alt="{{$renderedItem->product->product->images[0]->alt}}">
            </a>
        </div>
        <div class="text">
            <h3>
                <a href="{{route('product-overview', $renderedItem->product)}}">{{$renderedItem->product->name}}</a>
            </h3>
            <div class="subtotals">
                <p class="IndividualPrice">Precio Individual: ${{number_format($renderedItem->product->price, 2)}}mxn</p>
                <p class="Subtotal">Subtotal: ${{number_format($renderedItem->subtotal, 2)}}mxn</p>
            </div>
            <div class="amountControlls">
                <i class="fas fa-trash" wire:click="deleteCartProduct"></i>
                <input type="number" wire:model.lazy="quantity">
            </div>
        </div>
    </div>
@endif