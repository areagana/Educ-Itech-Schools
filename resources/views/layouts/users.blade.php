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

                <!--full calender scripts and css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        
        <!-- Styles -->
        <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/xdialog.3.4.0.min.css') }}" rel="stylesheet">
        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

       @include('popper::assets')
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">{{Auth::user()->school->school_name}}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        @auth
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-user-circle"></i> {{ Auth::user()->firstName}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Profile</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                </li>
                            </ul>
                        @endauth
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container">
                        <a class="navbar-brand" href="{{route('home')}}">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                            
                            </li>
                            @if(Auth::user()->hasRole(['administrator','superadministrator','ict-admin','school-administrator']))
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-lock"></i>
                                    Admin
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('userSubjects')}}" class="nav-link zoom"><i class="fa fa-book"></i> Subjects</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><i class="fa fa-tasks"></i> Tasks</a>   
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><i class="fa fa-inbox"></i> Inbox</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('calender')}}" class="nav-link"><i class="fa fa-calendar-o"></i> Calender</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link"><i class="fa fa-calendar"></i> Timetable</a>
                            </li>
                            @if(Auth::user()->hasRole('student'))
                            <li class="nav-item">
                                <a href="{{route('studentReport')}}" class="nav-link"><i class="fa fa-cog"></i> Reports</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="" class="nav-link"><i class="fa fa-cog"></i> Settings</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    @yield('crumbs')
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('assignment_content' );
            CKEDITOR.replace('textarea');
            for(i=0;i<=1000;i++)
            {
                CKEDITOR.replace('textarea'+i);
            }
        </script>
    </body>
</html>