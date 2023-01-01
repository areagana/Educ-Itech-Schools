@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row mx-2">
            <div class="col p-2">
                {{$subject->subject_name}} Edit
            </div>
        </div>
        <div class="row mx-2">
            <form action="{{route('subjectUpdate',$subject->id)}}" method='post'>
                @csrf
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Name:</label>
                    </div>
                    <div class="col p-2">
                        <input type="text" name='subject_name' value="{{$subject->subject_name}}" class="form-control" required>
                        <input type="hidden" name="school_id" value="{{$school->id}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Code:</label>
                    </div>
                    <div class="col p-2">
                        <input type="text" name='subject_code' value="{{$subject->subject_code}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Short:</label>
                    </div>
                    <div class="col p-2">
                        <input type="text" name='short_name' value="{{$subject->short_name}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Papers</label>
                    </div>
                    <div class="col p-2">
                        <input type="text" name='subject_papers' value="{{$subject->subject_papers}}" class="form-control" onblur="checkPapers($(this).val())" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Level</label>
                    </div>
                    <div class="col p-2">
                        <select name="subject_level" id="" class="form-control">
                            <option value="{{$subject->level->id}}">{{$subject->level->name}}</option>
                            @foreach($school->levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" id="subject_paper_options">
                    @if($subject->papers()->count() > 0)
                        @foreach($subject->papers as $paper)
                            <div class="p-2 mx-2">
                                {{$paper->name}}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-row border-bottom">
                    <div class="col p-2">
                        <button type='submit' class="btn btn-primary right">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function checkPapers(number)
        {
            if(number > 1)
            {
                var inputs ='';
                for(i=0;i< number;i++)
                {
                    var di = i+1;
                    inputs+="<label for=''> Paper "+di+"</label><input class='form-control' name='paper_names[]' id='paper"+di+"' placeholder='Enter paper name' required>";
                }
                $('#subject_paper_options').show();
                $('#subject_paper_options').html(inputs);
            }else{
                $('#subject_paper_options').hide();
            }
        }
    </script>
@endsection