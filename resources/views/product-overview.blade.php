<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/productOverview.css')}}">
    @endpush
    <x-slot name="title">Producto</x-slot>
    <div class="productOverviewContainer">
        @if ($product)
            @livewire('product-overview', ['product' => $product], key($product->id))
            <div class="reviewsContainer">
                <h2 class="reviewsTitle">Reseñas</h2>
                @livewire('product-comments', ['productGeneral' => $productGeneral], key($productGeneral->id))
            </div>
        @else
            <h2 class="noProduct">
                Lo sentimos, el producto que busca no existe, probablemente haya sido modificado,
                eliminado o nunca existió, intente con otro término
            </h2>
        @endif
    </div>
    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{mix('js/modules/productOverview.js')}}"></script>
    @endpush
</x-main>