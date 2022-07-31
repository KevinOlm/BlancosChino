@extends('adminlte::page')

@section('title', 'Blancos El Chino | Admin Editar Producto')

@section('content_header')
    <h1>Editar Producto {{$product->name}}</h1>
@stop

@section('content')
    @livewire('admin.product-edit', ['product' => $product])
@stop

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@stop