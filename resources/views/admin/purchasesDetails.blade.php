@extends('adminlte::page')

@section('title', 'Blancos El Chino | Admin Detalles de compra')

@section('content_header')
    <h1>Detalles de la compra número {{$id}}</h1>
@stop

@section('content')
    @livewire('admin.purchases-details', ['id' => $id])
@stop

@section('js')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{mix('js/admin/alerts.js')}}"></script>
@endsection