@props(['product'])

<div class="spetialOffer">
    <a href="{{route('product-overview', $product)}}">
        <div class="imageContainer">
            <div class="blurry"></div>
            <img
                class="image imgHorizontal"
                src="{{asset('storage/' . $product->product->images[0]->image)}}"
                alt="{{$product->product->images[0]->alt}}">
        </div>
        <div class="text">
            <h4>{{$product->name}}</h4>
            <div class="rateIcons">
                @for ($i = 0; $i < round($product->product->calification); $i++)
                <i class="fas fa-star rateIcon"></i>
                @endfor
                @for ($i = round($product->product->calification); $i < 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            </div>
            <p class="size">{{$product->size->size}}</p>
            <div class="prices">
                <p class="oldPrice">${{number_format($product->oldPrice, 2)}}mxn</p>
                <p class="price">${{number_format($product->price)}}mxn</p>
            </div>
        </div>
    </a>
</div>