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
            <!--side bar-->
            <div class="p-2 bg-secondary left-nav-users text-white">
                <ul class="nav">
                    <li class="nav-item nav-head"><b>{{Auth::user()->school->school_name}}</b></li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-user-circle"></i>
                            Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    @if(Auth::user()->hasRole(['administrator','superadministrator','ict-admin']))
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-lock"></i>
                            Admin
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('userSubjects')}}" class="nav-link">
                            <i class="fa fa-book"></i>
                            Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-tasks"></i>
                            Tasks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-inbox"></i>
                            Inbox
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fa fa-cog"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
            <div class="container-fluid main p-0">
                <!-- Top navbar -->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom p-0">
                    <a class="navbar-brand ml-2" href="#" onclick="Collapse('left-nav-users')">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="mt-3 page-crumbs">
                        @yield('crumbs')
                    </div>
                    <div class='right'>
                        <ul class="nav">
                            <li class="nav-item dropdown no-arrow right">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle rounded-circle" style="max-width: 60px"></i>
                                    <span class="ml-2 d-none d-lg-inline small">{{Auth::user()->firstName}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <h6 class="text-muted ml-2">Term 1 </h6>
                @yield('content')
            </div>
        </div>
         <!-- Bootstrap core JS-->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
    </body>
</html>