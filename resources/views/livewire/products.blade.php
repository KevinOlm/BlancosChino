<div wire:init="pageLoaded">
    <div class="productsContentContainer">
        <div class="filters">
            <div class="categoryFilter">
                <h2>Categoría</h2>
                <select name="category" id="selectCategory" wire:model="category">
                    <option value="Cualquiera">Cualquiera</option>
                    @foreach ($categories as $singleCategory)
                        <option value="{{$singleCategory->category}}">{{$singleCategory->category}}</option>
                    @endforeach
                </select>
            </div>
            <div class="sortFilter">
                <h2>Orden</h2>
                <select name="order" id="selectOrder" wire:model="sort">
                    <option value="id-desc">Más reciente primero</option>
                    <option value="id-asc">Más viejo primero</option>
                    <option value="name-asc">Alfabéticamente [A-Z]</option>
                    <option value="name-desc">Alfabéticamente [Z-A]</option>
                    <option value="price-asc">Menor precio primero</option>
                    <option value="price-desc">Mayor precio primero</option>
                    <option value="amountPurchased-desc">Más vendido primero</option>
                </select>
            </div>
        </div>
        <div class="productsContainer">
            @if (count($products))
                @foreach ($products as $item)
                    <x-product>
                        <x-slot name="image">
                            <a href="{{route('product-overview', $item)}}">
                                <span>{{($item->size->size === 'Sin tamaño')? 'Único tamaño' : $item->size->size}}</span>
                                <div class="blurry"></div>
                                <img 
                                    class="image imgHorizontal"
                                    src="{{asset('storage/' . $item->product->images[0]->image)}}"
                                    alt="{{$item->product->images[0]->alt}}">
                            </a>
                        </x-slot>
                        <x-slot name="name">
                            <a href="{{route('product-overview', $item)}}">{{$item->name}}</a>
                        </x-slot>
                        <div class="rateIcons">
                            <p>{{number_format(round($item->product->calification, 1), 1)}}</p>
                            @for ($i = 0; $i < round($item->product->calification); $i++)
                                <i class="fas fa-star rateIcon"></i>
                            @endfor
                            @for ($i = round($item->product->calification); $i < 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <div class="prices">
                            @if ($item->offerActive)
                                <p class="oldPrice">${{number_format($item->oldPrice, 2)}}mxn</p>
                            @endif
                            <p class="price">${{number_format($item->price, 2)}}mxn</p>
                        </div>
                    </x-product>
                @endforeach
                @if ($products->hasPages())
                    <div class="paginationContainer">{{$products->links('vendor.pagination.default')}}</div>
                @endif
            @else
                @if ($loaded)
                    <div class="noProducts"><h2>No hay productos existentes</h2></div>
                @else
                    <div class="noProducts"><p>Cargando productos</p></div>
                @endif
            @endif
        </div>
    </div>
</div>
