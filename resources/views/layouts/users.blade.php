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

        <!-- check here for the new scripts -->
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
    
      <!--page scripts-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>

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
                @include('layouts.inc.user-navbar')
                <?php
                    $school = Auth::user()->school;
                ?>
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
                                <!--<a href="" class="nav-link"><i class="fa fa-cog"></i> Settings</a>-->
                            </li>
                            <li class="nav-item">
                                <!--<a href="" class="{{(request()->routeIs('') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-inbox"></i> Inbox</a>-->
                            </li>
                            <li class="nav-item">
                                <!--<a href="{{route('calender')}}" class="{{(request()->routeIs('calender') ? 'navbar-brand' : 'nav-link')}}"><i class="fa fa-calendar-o"></i> Calender</a>-->
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
        

        <!-- Scripts -->
        <!--xdialog javascript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src = "{{asset('js/pdfJavascript.js')}}"></script>
        <script src="{{asset('assets/js/scripts.js')}}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
        <script src="{{ asset('assets/js/custom.js') }}" defer></script>
        <script src="{{ asset('js/xdialog.3.4.0.min.js') }}" defer></script>
        
        
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