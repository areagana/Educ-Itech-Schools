@Extends('schools.details')
@section('details')
    <div class="row mx-2 justify-content-center">
        <div class="col-md-6 col-md-offset-2 align-center p-2 ">
            <div class="card w-auto">
                <div class="card-header strong">
                    {{$school->school_name}} MARKSHEET GENERATION
                </div>
                <div class="card-body">
                    <form action="{{route('marksheetView')}}" method='POST' id='marksheet-form'>
                        @CSRF
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">ACADEMIC YEAR</span>
                                    </div>
                                    <select name="term_id" id="" class="form-control" onchange="loadTerms($(this).val())" required>
                                        <option value="">Select</option>
                                        @foreach($school->academicyears as $year)
                                            <option value="{{$year->id}}">
                                                {{$year->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT TERM</span>
                                    </div>
                                    <select name="term_id" id="term_id" class="form-control" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT EXAM</span>
                                    </div>
                                    <select name="exam_id" id="exam_id" class="form-control" required>
                                        <option value="">Select exam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT CLASS</span>
                                    </div>
                                    <select name="form_id" id="" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($school->forms as $form)
                                            <option value="{{$form->id}}">{{$form->form_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT STREAM</span>
                                    </div>
                                    <select name="stream_id" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($school->streams as $stream)
                                            <option value="{{$stream->id}}">{{$stream->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-flat right" form='marksheet-form'>Load Marksheet</button>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        function loadTerms(id)
        {
            if(id.length > 0)
            {
                $.ajax({
                    url:'/acyearterms',
                    data:{
                        id:id
                    },
                    dataType:'json',
                    success:function(resp){
                        var term_ ="";
                        // var data = JSON.parse(resp);
                        console.log(resp);
                        // $.each(resp.terms,function(index,term)
                        // {
                        //     term_+="<option value='"+term.id+"'>"+term.term_name+"</option>";
                        //     console.log(term);
                        // });
                        // $('#term_id').append(term_);
                    },
                    error:function(error){
                        // xdialog.alert('Error loading terms');
                        // console.log(error);
                    }
                });
            }
        }
    </script>
@endsection