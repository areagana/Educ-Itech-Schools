<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EDUC-ITECH') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>

        <!--xdialog javascript-->
        <script src="{{ asset('js/xdialog.3.4.0.min.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/xdialog.3.4.0.min.css') }}" rel="stylesheet">
       
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.css')}}">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        @include('layouts.inc.admin-navbar')
        <div id="layoutSidenav">
            @include('layouts.inc.admin-sidebar')
            <div id="layoutSidenav_content">
                <main>

                    @yield('content')

                </main>

                @include('layouts.inc.admin-footer')
            </div>
        </div>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/scripts.js')}}"></script>
    </body>
</html>