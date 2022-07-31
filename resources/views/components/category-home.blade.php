@if (count($productImages))
    <div class="categoryContainer">
        <h4>
            <a href="{{route('products', 'category=' . $category->category)}}">
                {{$category->category}}
            </a>
        </h4>
        <a class="imagesContainer" href="{{route('products', 'category=' . $category->category)}}">
            <div class="blurry"></div>
            @foreach ($productImages as $image)
                <div class="imageContainer">
                    <img
                        class="image imgHorizontal"
                        src="{{asset('storage/' . $image[0]->image)}}"
                        alt="{{$image[0]->alt}}">
                </div>
            @endforeach
        </a>
        <p><a href="{{route('products', 'category=' . $category->category)}}">Ver más</a></p>
    </div>
@endif