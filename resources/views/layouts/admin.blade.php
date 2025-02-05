@extends('layout')
@section('title', 'Panel de admin')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('layouts.navigation')
            
            <!-- Contenido Principal -->
            <div class="content-wrapper">
                @yield('content')
            </div>

        
        </div>
    </body>
@endsection