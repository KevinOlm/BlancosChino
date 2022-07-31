<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/products.css')}}">
    @endpush
    <x-slot name="title">Productos</x-slot>
    <div class="productsPageContainer">
        <h1>Productos</h1>
        @livewire('products')
    </div>
</x-main>