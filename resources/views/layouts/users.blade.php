<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{Auth::user()->school->school_name}}</title>

        <!--xdialog javascript-->
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
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

        <!--favicon-->
      <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">

       @include('popper::assets')

        <!--loading spinners-->
        <div id='spinners-div'>
          <div class='spinners'>
            <div class='spinners'>
              <img src="{{asset('loadingspinners.gif')}}" alt="" width='300px' height='300px'></img>
            </div>
          </div>
        </div>
    </head>
    <body class='flex' onload="pageloaderfunction()">
        <div class="d-flex" id="wrapper">
            <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        @php
                            $school = Auth::user()->school;
                        @endphp
                        @if(Auth::user()->hasRole(['student']))
                            @php
                                $form = Auth::user()->forms->first();
                            @endphp 
                        @endif
                        <a class="navbar-brand" href="#">{{Auth::user()->school->school_name}}</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        @auth
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a href="" class="nav-link"><i class="fa fa-bell"></i></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-user-circle"></i> {{ Auth::user()->firstName}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!"><i class="fa fa-user"></i> Profile</a>
                                        <a href="{{route('newPassword.form')}}" class="dropdown-item"><i class="fa fa-lock"></i> Change Password</a>
                        <!-- divider-->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endauth
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbarNav navbar-expand-lg navbar-dark bg-dark">
                    <div class="container">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="{{(request()->routeIs('home') ? 'navbar-brand' : 'nav-link')}}">Dashboard</a>
                            </li>
                        </ul>
             <!-- placeholder for navbar toggler- button-->
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            @if(Auth::user()->hasRole(['administrator','superadministrator','ict-admin','school-administrator']))
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-lock"></i>
                                    Admin
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('userSubjects')}}" class="{{(request()->routeIs('userSubjects') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-book"></i> Subjects</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="{{(request()->routeIs('') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-inbox"></i> Inbox</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('calender')}}" class="{{(request()->routeIs('calender') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-calendar-o"></i> Calender</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ann.user')}}" class="{{(request()->routeIs('ann.user') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-bell"></i> Notice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('schoolTimetables',$school->id)}}" class="{{(request()->routeIs('schoolTimetables') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-calendar"></i> Timetable</a>
                            </li>
                            @if(Auth::user()->hasRole('student'))
                            <li class="nav-item">
                                <a href="{{route('studentReport')}}" class="{{(request()->routeIs('studentReport') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-cog"></i> Reports</a>
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
        <!--success message displayed here-->
                    @if(session('success'))
                        <div class="success-alert-message bg-white shadow border border-success row p-2 position-absolute m-4">
                            <div class="col-md-1">
                            <img src="{{asset('notice-icon.jpg')}}" alt="" width='40px' height='40px' class='rounded-circle'>
                            </div>
                            <div class="col-md-10 p-2 bg-white">
                            {{session('success')}}
                            </div>
                            <div class="col-md-1 p-2">
                            <button class="close" data-dismiss='alert' onclick="Close('success-alert-message')">&times;</button>
                            </div>
                        </div>
                    @endif
        <!--end success message-->
                    @yield('content')
                </div>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        
    <!--load libraries to allow pdf tool functionality-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
        <script>pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
        <!-- javascript that loads pdf tool-->
        <script src = "{{asset('js/pdfJavascript.js')}}"></script>

        <!-- Scripts -->
        
        


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