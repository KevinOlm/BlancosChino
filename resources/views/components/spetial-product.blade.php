@props(['spetialProduct'])

<div class="spetialProduct">
    <x-product-contact-background>
        <x-slot name="graphic">
            <div class="imageContainer">
                <a href="{{route('product-overview', $spetialProduct)}}">
                    <span class="size">
                        {{($spetialProduct->size->size === 'Sin tamaño')? 'Único tamaño' : $spetialProduct->size->size}}
                    </span>
                    <div class="blurry"></div>
                    <img 
                        class="image imgHorizontal" 
                        src="{{asset('storage/' . $spetialProduct->product->images[0]->image)}}" 
                        alt="{{$spetialProduct->product->images[0]->alt}}">
                </a>
            </div>
        </x-slot>

        <div class="text">
            <a href="{{route('product-overview', $spetialProduct)}}"><h3>{{$spetialProduct->name}}</h3></a>
            <div class="rateIcons">
                <p>
                    {{number_format(round($spetialProduct->product->calification, 1), 1)}} 
                    de {{$spetialProduct->product->calificationNumber}} usuarios
                </p>
                @for ($i = 0; $i < round($spetialProduct->product->calification); $i++)
                    <i class="fas fa-star rateIcon"></i>
                @endfor
                @for ($i = round($spetialProduct->product->calification); $i < 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            </div>
            <p class="description">{{$spetialProduct->description}}</p>
            <div class="prices">
                @if ($spetialProduct->offerActive)
                    <p class="oldPrice">${{number_format($spetialProduct->oldPrice, 2)}}mxn</p>
                @endif
                <p class="price">${{number_format($spetialProduct->price)}}mxn</p>
            </div>
        </div>
    </x-product-contact-background>
</div>