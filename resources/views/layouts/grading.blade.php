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
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-info bg-info border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav ms-auto mt-2">                            
                            <li class="nav-item">
                                <span class="h5">
                                    <a href="{{route('assignments',$assignment->subject->id)}}" class="nav-link text-white">{{$assignment->assignment_name}} Grading/Marking</a>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="mx-2">
                                    Total Marks: X/{{$assignment->total_points}}
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="mx-2">
                                    Total submissions: {{$assignment->assignment_submissions->count()}} out of {{$assignment->subject->users->count()}}
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="mx-2">
                                    Graded: <Graded:span class="graded"></Graded:span>
                                </span>
                            </li>
                        </ul>
                        @auth
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                  <li class="nav-item">
                                    <span class="">
                                        <select name="submitted_users" id="submission_list" class="custom-input" style='width:200px' onchange="fetchSubmittedAssignment({{$assignment->id}},$(this).val())">
                                            <option value="" hidden>Select student</option>
                                            @foreach($submissions as $submitted)
                                                <option value="{{$submitted->user->id}}">{{$submitted->user->firstName}} {{$submitted->user->lastName}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                  </li>  
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
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
