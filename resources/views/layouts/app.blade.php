<!DOCTYPE html>
<html {{ language_attributes() }} lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="{{ bloginfo('charset') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, minimum-scale=1, maximum-scale=10,user-scalable=no,initial-scale=1.0">
    <link rel="shortcut icon" href="{{ public_url('images/favicon.ico') }}" type="image/vnd.microsoft.icon" />
    <link rel="apple-touch-icon-precomposed" href="{{ public_url('images/apple-touch-icon-precomposed.png') }}">
    <link rel="stylesheet" href="{{ get_stylesheet_uri() }}">
    {{-- <link rel="stylesheet" href="{{ public_url('css/app.css') }}"> --}}
    <link href="{{ public_url('css/fontawesome.css') }}" rel="stylesheet">
    {{-- <link href="{{ public_url('css/brands.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ public_url('css/solid.css') }}" rel="stylesheet"> --}}
    <!--vite 1 https://owenconti.com/posts/replacing-laravel-mix-with-vite -->
    {{-- @vite --}}
    {{-- <link href="{{ public_url('webfonts/webfont-articulat.css') }}" rel="stylesheet"> --}}
    <script src="{{ public_url('js/jquery-3.7.1.min.js') }}"></script>
    {{-- <script src="{{ public_url('js/app.js') }}"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script defer src="{{ public_url('js/alpine.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- start::head --}} @yield('head') {{-- end::head --}}
    {!! wp_head() !!}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    {{-- <link rel="stylesheet" href="{{ public_url('dist/css/app.css') }}"> --}}


    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    {{-- <script type="module" src="https://foundandscan.co.bd:5173/@vite/client"></script> --}}
    <link rel="stylesheet" href="https://foundandscan.co.bd:5173/resources/css/app.css" />
    <script type="module" src="https://foundandscan.co.bd:5173/resources/js/app.js"></script>
</head>

<body {{ body_class('bg-white dark:bg-dark') }}>
    {!! wp_body_open() !!}

    {{-- start::header --}}
    @include('layouts.header')
    {{-- end::header --}}

    {{-- start::content --}}
    @yield('content')
    {{-- end::content --}}

    <main id="main" class="{{ theme_class() }}">

        {{-- start::content --}}
        <div class="py-10">
            @isset($header)
                {!! $header !!}
            @endisset
        </div>
        {{-- end::content --}}

        {{-- start::body --}}
        @yield('body')
        {{-- end::body --}}


        {{-- start::content --}}
        @isset($slot)
            {!! $slot !!}
        @endisset
        {{-- end::content --}}
    </main>

    {{-- start::section --}}
    @yield('section')
    {{-- end::section --}}

    {{-- start::footer --}}
    @include('layouts.footer')
    {{-- end::footer --}}

    {!! wp_footer() !!}
    {{-- start::scripts --}}
    @yield('scripts')
    {{-- end::scripts --}}
</body>

</html>
