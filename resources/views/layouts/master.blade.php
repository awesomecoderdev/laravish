<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, minimum-scale=1, maximum-scale=10,user-scalable=no,initial-scale=1.0">
    <link rel="shortcut icon" href="{{ public_url('images/favicon.ico') }}" type="image/vnd.microsoft.icon" />
    <link rel="apple-touch-icon-precomposed" href="{{ public_url('images/apple-touch-icon-precomposed.png') }}">
    <link rel="stylesheet" href="{{ get_stylesheet_uri() }}">
    <link rel="stylesheet" href="{{ public_url('css/app.css') }}">
    <link href="{{ public_url('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ public_url('css/brands.css') }}" rel="stylesheet">
    <link href="{{ public_url('css/solid.css') }}" rel="stylesheet">
    <link href="{{ public_url('css/tailwindOutput.css') }}" rel="stylesheet">
    <link href="{{ public_url('webfonts/webfont-articulat.css') }}" rel="stylesheet">
    <script src="{{ public_url('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ public_url('js/app.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')

    <?php wp_head(); ?>
</head>

<body>
    <header class="site-header">
        {{-- start::navigation --}}
        @include('layouts.header')
        {{-- end::navigation --}}
        {{-- wp_nav_menu() --}}
    </header>

    <div class="container px-3 mx-auto">

        @if (env('APP_ENV') === 'production')
            <script>
                // scripts only should be ran on production server.
            </script>
        @endif

        <div class="site">

            <main class="site-main">
                <div class="content">
                    @yield('content')
                </div>
                <!--footer class="site-footer">
            @yield('footer')
            <div>Legal notices</div>
            <div>About us</div>
            <div>Contact</div>

            <?php wp_footer(); ?>

        </footer-->
            </main>

        </div>

    </div>
</body>

</html>
