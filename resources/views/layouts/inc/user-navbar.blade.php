<nav class="sb-topnav navbar navbar-expand navbar-light bg-success">
    @php

        $school = (!is_array($school)) ? Auth::user()->school : [];
    @endphp
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('home')}}">{{ ((is_array($school) && count($school) > 0) OR (!is_array($school) && $school->count() > 0)) ? $school->school_name :'EDUCITECH'}}</a>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->firstName}}
                <img src="{{asset('placeholder-profile.jpg')}}" width='30px' height='30px' class='rounded-circle'>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('newPassword.form')}}"><i class="fas fa-lock"></i> Change Password</a></li>
                <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fas fa-user"></i> Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item"  href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Sign out</a>
                    <form id="logout-form" action="{{route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>