<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/home.css')}}">
    @endpush
    <x-slot name="title">Inicio</x-slot>
    <x-slider/>
    <div class="mainContent">
        @if ($spetialProduct)
            <h2>Nuestro producto más vendido</h2>
            <x-spetial-product :spetialProduct="$spetialProduct"/>
        @endif
        @if (count($spetialOffers))
            <h2>Comprueba nuestras ofertas Especiales</h2>
            <div class="spetialOffersContainer">
                @foreach ($spetialOffers as $product)
                    <x-spetial-offer :product="$product"/>
                @endforeach
            </div>
        @endif
        @if (count($categories))
            <h2>Da un vistazo a nuestras categorías disponibles</h2>
            <div class="scrollContainer">
                <div class="scrollTop"><i class="fas fa-angle-up"></i></div>
                <div class="categoriesContainer">
                    @foreach ($categories as $category)
                        <x-category-home :category="$category"/>
                    @endforeach
                </div>
                <div class="scrollBottom"><i class="fas fa-angle-down"></i></div>
            </div>
        @endif
    </div>
    @push('scripts')
        <script src="{{mix('js/modules/slider.js')}}"></script>
        <script src="{{mix('js/modules/categoriesHome.js')}}"></script>
    @endpush
</x-main>