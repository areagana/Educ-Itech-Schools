<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$school->school_code}}</title>

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
    </head>
    <body>
        @include('layouts.sch.school-navbar')
        <div id="layoutSidenav">
            @include('layouts.sch.school-sidebar')
            <div id="layoutSidenav_content">
                <main>
                  <div class="row mx-0 p-2">
                    <div class="col p-2">
                      @yield('crumbs')

                      @if(session('success'))
                        <div class="success-alert-message bg-white shadow border border-success row p-2 position-absolute m-4">
                          <div class="col-md-1">
                            <img src="{{asset('notice-icon.jpg')}}" alt="" width='40px' height='40px' class='rounded-circle'>
                          </div>
                          <div class="col-md-10 p-2 bg-white message-display">
                            {{session('success')}}
                          </div>
                          <div class="col-md-1 p-2">
                            <button class="close" data-dismiss='alert' onclick="Close('success-alert-message')">&times;</button>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  
                  @yield('schoolContent')

                </main>

                @include('layouts.sch.school-footer')
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
        <!-- Bootstrap core JS-->
        <!-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
        <!-- javascript that loads pdf tool-->
        <script src = "{{asset('js/pdfJavascript.js')}}"></script>
        <script src="{{asset('assets/js/scripts.js')}}"></script>


        <script>
           function searchStudent(val)
          {
            var school_id = $('#mySchool').val();
            console.log(school_id);
            if(val.length > 1)
            {
              $('#student_search_results').show();

              $.ajax({
                url:"/student/search",
                data:{
                  text:val,
                  school_id:school_id
                },
                beforeSend:function(){
                  $('#Search_results_display').html('Loading data ...');
                },
                success:function(res){
                  var record ='';
                  $.each(res.students,function(index,student){
                    record +="<div class='border-bottom p-2'><a class='nav-link' href='/students/"+student.id+"/view'>"+
                                student.firstname+" "+student.lastname+
                              "</a></div>";
                  });

                  $('#Search_results_display').html(record);
                },
                error:function(err){
                  console.log(err);
                }
              });
            }else{
              $('#student_search_results').hide();
            }
          }
        </script>
    </body>
</html>