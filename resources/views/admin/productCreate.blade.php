@extends('adminlte::page')

@section('title', 'Blancos El Chino | Admin Crear Producto')

@section('content_header')
    <h1>Creación de un Producto</h1>
@stop

@section('content')
    @livewire('admin.product-create')
@stop

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection