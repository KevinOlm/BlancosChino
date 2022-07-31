@props(['name'])
<div class="product">
    <div class="imageContainer">
        {{$image}}
    </div>
    <div class="text">
        <h3>{{$name}}</h3>
        {{$slot}}
    </div>
</div>