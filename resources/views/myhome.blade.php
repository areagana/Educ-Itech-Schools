@Extends('layouts.home')
@section('homeContent')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 bg-white mx-1">
                <img src="{{asset('EDUC-ITECH logo edited.png')}}" alt="" width="320px" height="280px" class='m-4'>
            </div>
            <div class="col p-2 bg-white mx-1">
                <div class="header h4">OUR VISION</div>
                <p class='p-2 justify-content-center'>
                        To improve the education sector by creating applications that help in data tracking, 
                        progress tracking and monitoring of the teaching and learning activities, counseling and behaviour
                        monitoring of students and staff welfare.
                </p>
                <div class="header h4">OUR MISSION</div>
                <p class='p-2 justify-content-center'>
                    To train an overall leaner, well informed of the future prospects, what he/she wants to do,
                    where to find it with data informed decisions made,
                     trained by the IT literate teachers guiding the learning process.
                </p>
            </div>
            <div class="col p-2 bg-white mx-1">
                @yield('authForms')
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2 bg-white m-1">
                <div class="header h3">OUR PRODUCTS</div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2 bg-white m-1">
                <div class="header h5">PRODUCTS</div>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('EDUC-ITECH logo edited.png')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('school-assistant.png')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('counseling-app.png')}}" class="d-block w-100" alt="...">
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2 bg-white m-1">
                <div class=" header p-2 h6">Our Products</div>
                We have been able to successfully build these products and are currectly running.
                <li class='border-bottom m-2'>
                    <b>School-Assistant:</b><br> This is a module that assists schools in tracking academic data of the students
                    with a database, able to promote students from one class to another,
                    with marksheets, gradesheets, analysis for results, behaviour tracking and other information as required by the school.
                </li>
                <li class='border-bottom m-2'>
                    <b>MyCousellor: </b><br>
                    This application is used in schools and other places to keep counseling data from students, teachers, and other people
                    depending on the sector using it. It is an easy to use application and data is independently kept and accessed by the people
                    incharge when in need.
                </li>
                <li class='border-bottom m-2'>
                    <b>Sacco management system</b><br>
                    This keeps all information about sacco members, their savings, loans, withdraws and other information.
                    It is able to generate reports as needed by the adminstrators, generate statements and other information as 
                    required by the sacco.
                </li>
                <li>
                    Contact us to get more about aur products and get your self a product to manage your data.
                </li>
                <p>Get more information from our github account by opening this link <br>
                    <a href="https://github.com/areagana" class="nav-link" target=_blank><i class="fa fa-github" aria-hidden="true"></i> Github link</a>
                </p>
            </div>
        </div>
    </div>
@endsection