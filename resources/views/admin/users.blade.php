@extends('adminlte::page')

@section('title', 'Blancos El Chino | Admin Usuarios')

@section('content_header')
    <h1>Administración de Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users')
@stop

@section('js')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{mix('js/admin/alerts.js')}}"></script>
@endsection