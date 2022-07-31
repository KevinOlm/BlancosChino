<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/products.css')}}">
    @endpush
    <x-slot name="title">Carrito</x-slot>
    <div class="productsPageContainer">
        <h1>Tu Carrito</h1>
        @livewire('products-shoppingcart')
    </div>
    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{mix('js/modules/shoppingcart.js')}}"></script>
    @endpush
</x-main>