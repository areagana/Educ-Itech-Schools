@Extends('layouts.home')
@section('homeContent')
    <div class="container-fluid">
        <div class="row bg-light p-2">
            <div class="col p-2 bg-white">
                <div class="h1 header text-success">
                    <center>
                        Learn With Us
                    </center>
                </div>
                <img src="{{asset('coding class.png')}}"  width="100%" height='600px'>
                <div class="web-content p-2 row">
                    <div class="col p-1">
                        <h1>Coding with Instructors</h1>
                        Get started to coding classes with our experinced teachers.
                    </div> 
                    <div class="col-md-4 p-2">
                        <h5>Send us an email: </h5>
                        rahimbisibwe@educitech.com <br>
                        Call on Or whatsapp: +256785873313/+25670958895
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col p-2 readable-content">
                <p>
                    We provide possible solutions to the academic world, with systems that simplifies data tracking,
                    report making, behaviour tracking, counseling, and many more. 
                </p>
                <p>
                    We provide online coding services where you are able to interract with our trained tutors directly,
                    ask questions and get solutions, do projects and get timely guidance through video calls and project assignment, and assessment
                    that improves our student to the level where coding is just a game.
                </p>
            </div>
        </div>
        <div class="row bg-white">
            <div class="h1 header text-primary">
                <center>
                    Our Products
                </center>
            </div>
            <div class="col p-3 m-1 bg-white shadow-sm">
                <img src="{{asset('school-assistant.png')}}"  width="100%" height='615px'>
            </div>
            <div class="col mx-1">
                <div class="row m-1 bg-white shadow-sm">
                    <div class="col p-2">
                        <img src="{{asset('counseling-app.png')}}"  width="100%" height='300px'>
                    </div>
                </div>

                <div class="row m-1 bg-white shadow-sm">
                    <div class="col p-2">
                        <img src="{{asset('coding class.png')}}"  width="100%" height='300px'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2 bg-success">
            <div class="col p-2 bg-success">
                <div class="h2 text-white">

                </div>
            </div>
            <div class="col p-2 bg-success">
                check here
            </div>
            <div class="col p-2 bg-success">
                check here
            </div>
        </div>
        <div class="row p-2 bg-info">
            <div class="col p-2">
                <div class="h2 text-white">
                    About Us
                </div>
                <p>
                    We develop laravel based sofwares for academics, business and any other 
                    basing on your demand. 
                </p>
            </div>
            <div class="col p-2">
                <div class="h2 text-white">
                    What we do
                </div>
                <p>
                    We develop laravel based sofwares for academics, business and any other 
                    basing on your demand. 
                </p>
            </div>
            <div class="col p-2">
                <div class="h2 text-white">
                    Contact us
                </div>
            </div>
        </div>
    </div>
@endsection