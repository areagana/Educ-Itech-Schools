<nav class="sb-topnav navbar navbar-expand navbar-light bg-success">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('home')}}">{{$school->school_name}}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control w-100" type="text" placeholder="Search student..." aria-label="Search for..." onkeyup="searchStudent($(this).val())" aria-describedby="btnNavbarSearch" />
            <input type="hidden" name="school_id" value='{{$school->id}}' id='mySchool'>
            <!-- display search results -->
            <!-- <div class="row p-2 bg-white shadow-sm mx-1 absolute hidden w-100 border mt-4" id='student_search_results'>
                <div class="col p-2" id='Search_results_display'></div>
            </div>             -->
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="fas fa-bell"></i></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="fas fa-envelope"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{(Auth::user()) ? Auth::user()->firstName : ""}}
                <img src="{{asset('placeholder-profile.jpg')}}" width='30px' height='30px' class='rounded-circle'>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('newPassword.form')}}"><i class="fas fa-lock"></i> Change Password</a></li>
                <li><a class="dropdown-item" href="#!"><i class="fas fa-user"></i> Profile</a></li>
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