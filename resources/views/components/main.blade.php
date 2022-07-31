<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }} | {{$title}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Blancos El Chino es una empresa especializada en la distribución de blancos y otros productos textiles para el hogar o el negocio, con venta en línea o por mayoreo.">
        <meta name="keywords" content="venta de blancos, distribución de blancos, venta de blancos en línea, mayoreo de blancos, edredónes, cobertores, colchas, sábanas, cortinas, cubresalas, manteles, toallas, cubrecolchones, cama,">
        <meta name="author" content="Kevin Olmeda">
        <meta name="copyright" content="Blancos El Chino">
        <meta name="robots" content="index">
        <meta property="og:title" content="{{ config('app.name', 'Laravel') }} | {{$title}}">
        <meta property="og:description" content="Blancos El Chino es una empresa especializada en la distribución de blancos y otros productos textiles para el hogar o el negocio, con venta en línea o por mayoreo.">
        <meta property="og:url" content="{{request()->url()}}">
        <meta property="og:image" content="{{asset('/img/logo_blancos_el_chino.png')}}">
        <meta property="og:locale" content="es_LA">


        <!-- Styles -->	
        <link rel="canonical" href="{{request()->url()}}">
        <link rel="icon" href="{{asset('/favicons/favicon.PNG')}}" type="image/png"/>
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        @stack('styles')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/9372b6e98b.js" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="wrapper">
            <x-header />
            
            <main>
                {{ $slot }}
            </main>

            <x-footer />
        </div>

        @livewireScripts

        <script src="{{mix('js/modules/images.js')}}"></script>

        @stack('scripts')
        
        @stack('modals')
    </body>
</html>