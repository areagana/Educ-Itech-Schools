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
            <!-- Sidebar-->
            @auth
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-info">
                    <img src="" alt="" class='nav-logo bg-white m-1'>
                    {{ config('app.name', 'EDUC-ITECH') }}
                </div>
                <div class="list-group list-group-flush">
                @if(Auth::user())
                    @if(Auth::user()->hasRole(['superadministrator','administrator','manager']))
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('home')}}">Dashboard</a>
                    @endif
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('schools')}}">Schools</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="">Classe</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="">Subjects</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#expenses-more" data-toggle="collapse">Users</a>
                    <ul class='collapse' id="expenses-more">
                        <a href="" class="list-group-item list-group-item-action list-group-item-light p-3">Leaders</a>
                        <a href="" class="list-group-item list-group-item-action list-group-item-light p-3">Teachers</a>
                    </ul>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="">Reports</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="">Settings</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#logout" data-toggle="collapse">{{Auth::user()->firstName}}</a>
                    <ul class='collapse' id="logout">
                        <a class="list-group-item list-group-item-action list-group-item-light p-3 text-danger h3" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                @endif
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg  navbar-fixed-top navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <i class="fa fa-bars p-2 hide-left-nav btn btn-light h3" id="sidebarToggle"></i>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        
                        @auth
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->firstName}}</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Profile</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endauth
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid mt-4">
                        @if(session('success'))
                            <div class="bg-white success shadow">
                                <h4 class="header bg-light p-3">
                                    MESSAGE
                                    <span class="right">
                                        <button class="btn btn-danger btn-sm close-session-msg" onclick="closeParent3()">&times;</button>
                                    </span>
                                </h4>
                                <div class="p-3 h4">
                                    
                                    {{session('success')}}
                                </div>
                            </div>
                        @endif
                    @endauth
                    @yield('crumbs')
                    @yield('content')
                </div>
            </div>
        </div>
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
