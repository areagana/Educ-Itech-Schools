    @Extends('layouts.users')
    @section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <div class="row p-2">
        <div class="p-2 col">
            <h4 class="header">FULL CALENDER EXAMPLE</h4>
            <div class="p-2" id="calender">

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'x-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calender = $('#calender').fullCalendar({
                    editable:true,
                    header:{
                        left:'prev,title,next',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    }
                });
        });
    </script>
@endsection