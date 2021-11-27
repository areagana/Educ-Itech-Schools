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

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

                <!--full calender scripts and css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        
	    
        
        <!-- Styles -->
        <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/xdialog.3.4.0.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/pdfTool.css')}}" rel='stylesheet'>
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

      <script>
          var storage_path = "{!! storage_path('app/Assignments/Submitted/') !!}";
      </script>
       @include('popper::assets')
       @include('includes.functions')
    </head>
    <body>
    <!--toolbar for the marking process--->
        <div class="toolbar">
            <div class="tool">
                <!-- replace this with assignment name-->
                <a href="{{route('assignments',$assignment->subject->id)}}" class="nav-link p-2 border text-white">{{$assignment->assignment_name}}</a>
            </div>
            <div class="tool">
                <label for="">Brush size</label>
                <input type="number" class="form-control text-right" value="1" id="brush-size" max="50">
            </div>
            <div class="tool">
                <label for="">Font size</label>
                <select id="font-size" class="form-control">
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="16" selected>16</option>
                    <option value="18">18</option>
                    <option value="24">24</option>
                    <option value="32">32</option>
                    <option value="48">48</option>
                    <option value="64">64</option>
                    <option value="72">72</option>
                    <option value="108">108</option>
                </select>
            </div>
            <div class="tool">
                <button class="color-tool active" style="background-color: #212121;"></button>
                <button class="color-tool" style="background-color: red;"></button>
                <button class="color-tool" style="background-color: blue;"></button>
                <button class="color-tool" style="background-color: green;"></button>
                <button class="color-tool" style="background-color: yellow;"></button>
            </div>
            <div class="tool">
                <button class="tool-button active"><i class="fa fa-hand-paper-o" title="Free Hand" onclick="enableSelector(event)"></i></button>
            </div>
            <div class="tool">
                <button class="tool-button"><i class="fa fa-pencil" title="Pencil" onclick="enablePencil(event)"></i></button>
            </div>
            <div class="tool">
                <button class="tool-button"><i class="fa fa-font" title="Add Text" onclick="enableAddText(event)"></i></button>
            </div>
            <div class="tool">
                <button class="tool-button"><i class="fa fa-long-arrow-right" title="Add Arrow" onclick="enableAddArrow(event)"></i></button>
            </div>
            <div class="tool">
                <button class="tool-button"><i class="fa fa-square-o" title="Add rectangle" onclick="enableRectangle(event)"></i></button>
            </div>
            <div class="tool">
                <button class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
            </div>
            <div class="tool">
                <button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
            </div>
            <div class="tool">
                <button class="btn btn-danger btn-sm" onclick="clearPage()">Clear Page</button>
            </div>
            <div class="tool">
                
                <span class="mx-2 p-2">
                    <select name="submitted_users" id="submission_list" class="custom-select"  onchange="fetchSubmittedAssignment({{$assignment->id}},$(this).val())">
                        <option value="" hidden>Select student</option>
                            @foreach($submissions as $submitted)
                                <option value="{{$submitted->user->id}}">{{$submitted->user->firstName}} {{$submitted->user->lastName}}</option>
                            @endforeach
                    </select>
                </span>
                <button class="btn btn-light btn-sm" onclick="savePDF($('#submission_list').val())"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

    <!--end pdf tool here-->
        <div class="container-fluid mt-3">
            <!-- holds the pdf content-->
            <div id="pdf-container" class='grading-tool-body'></div>

            <div class="row p-1">
                <div id="pdf-container" class='assignment-displayed col p-4'>
                    <!--holds the pdf document displayed-->
                </div>

            <!-- assignment details displayed here-->
                <div class="col-md-2 p-2 border-left bg-white mx-1">
                    <div class="header h4">Assignment Details</div>
                    <label for="user-attachments" class="form-label"></label>
                    <input type="hidden" name="submission_id" id='submission_id'>
                    <input type="hidden" name="" id='document_link'>
                    <select name="" id="user-attachments" class="form-control" onchange="loadAttachment($(this).val())"></select>

            <!--add grades-->
                    <div class="p-2">
                        <div class="header h4">Marks / Grades</div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="assigned_grade"  onblur="submitGrade($(this).val(),{{$assignment->total_points}},$('#submission_id').val())" style="width:60px" min='0'>
                            <label for="assigned_grade">/ {{$assignment->total_points}}</label>
                        </div>
                    </div>

            <!--check the graded students/ works-->
                    <div class="mx-2 mt-2 p-2 border">
                        <b>Graded:</b> <span class="graded"></span>
                    </div>
            <!--check the submitted student numbers here-->
                    <div class="mx-2 p-2 border mt-1">
                        <b>Submitted:</b> {{$assignment->assignment_submissions->count()}} out of {{$assignment->subject->users->count()}}
                    </div>
            <!--add comments-->
                    <div class="p-2">
                        <div class="header h4">Comments</div>
                        <div class="p-2 submission-comments">
                            
                        </div>
                        <textarea type="text" class="form-control" id="assigned_comment"  cols='20' rows='3' onblur="saveComment($(this).val(),$('#submission_id').val())"></textarea>
                        <div class="p-2">
                            <form action="{{route('submissionFeedback')}}" id="graded-attachment-form" enctype='multipart/form-data' method='POST' >
                                @csrf
                                <i class="fa fa-paperclip"> Attach Graded Work</i>
                                <span class="right"><i class="fa fa-plus btn btn-circle btn-sm text-info btn-light" title='Add attachment' onclick="addGradedAttachment()"></i></span>
                                <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                                <input type="hidden" name="feedback_submission_id" id='feedback_submission_id'>
                                <input type="file" name="graded_work[]" id="graded_work" class='form-control'>
                            </form>
                        </div>
                        <div class="p-1 row">
                            <div class="col p-2">
                                <button class="btn btn-sm btn-primary right" type='submit' form='graded-attachment-form'>Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--scripts to run the page-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
        <script>pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>

        <!--pdf javascript functions-->
        <script src ="{{ asset('js/pdfJavascript.js')}}"></script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>

        <!--xdialog javascript-->
        <script src="{{ asset('js/xdialog.3.4.0.min.js') }}" defer></script>
    </body>
</html>