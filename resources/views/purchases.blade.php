<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/purchases.css')}}">
    @endpush
    <x-slot name="title">Compras</x-slot>
    <div class="purchasesContentContainer">
        <h1>Compras</h1>
        @livewire('purchases')
    </div>
</x-main>