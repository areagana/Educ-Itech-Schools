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
        @include('popper::assets')
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"><img src="{{asset('EDUC-ITECH logo edited.png')}}" alt="" width='50px' height='50px'> <b>EDUC-ITECH-SCHOOLS</b></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="{{(request()->routeIs('frontPage') ? 'currenton':'')}}">
                                        <a class="nav-link" aria-current="page" href="{{route('frontPage')}}">Home</a>
                                    </li>
                                    <li class="{{(request()->routeIs('services') ? 'currenton':'')}}">
                                        <a class="nav-link" href="{{route('services')}}">Our Services</a>
                                    </li>
                                    <li class="{{(request()->routeIs('contacts') ? 'currenton':'')}}">
                                        <a class="nav-link" href="{{route('contacts')}}">Contact us</a>
                                    </li>
                                    <li class="{{(request()->routeIs('clients') ? 'currenton':'')}}">
                                        <a class="nav-link" href="{{route('clients')}}">Our Clients</a>
                                    </li>
                                    <li class="{{(request()->routeIs('howto') ? 'currenton':'')}}">
                                        <a class="nav-link" href="#">How to</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-inline">
                                <ul class="navbar-nav">
                                    <li class="nav-item my-2 my-sm-0">
                                        <a class="btn btn-info navbar-btn " aria-current="page" href="#">Signup</a>
                                    </li>
                                    <li class="nav-item my-2 my-sm-0">
                                        <a class="btn btn-success navbar-btn " aria-current="page" href="{{route('login')}}">Login</a>
                                    </li>
                                </ul>
                            </div>
                    </div>

                </nav>
                <!-- Page content-->
                <div class="container-fluid mt-4">
                    @yield('homeContent')
                </div>
            </div>
        </div>
        <nav class="navbar fixed-bottom navbar-light text-white">
            <div class="container nav-text">
                CopyRight@educ-itech LTD. Email:educitech21@gmail.com.
                <span class="right">
                    Contacts: +256705958895/+256785873313
                </span>
            </div>
        </nav>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('assignment_content' );
            CKEDITOR.replace('textarea');
        </script>
    </body>
</html>
