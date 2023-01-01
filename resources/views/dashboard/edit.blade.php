@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row mx-2">
            <div class="col p-2">
                <h3 class='border-bottom p-2'>{{$card->user->firstName}} {{$card->user->lastName}} / {{$card->id}}</h3>
            </div>
        </div>
        <div class="row mx-2">
            <div class="col p-3 border border-primary">
                <form action="{{route('cardUpdate',$card->id)}}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="level_id">LEVEL</label>
                        <select name="level_id" id="level_id" class="form-control" onchange="loadLevelData($(this).val())">
                            <option value="{{$level->id}}">{{$level->name}}</option>
                            @foreach($school->levels as $lev)
                                <option value="{{$lev->id}}">{{$lev->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="teacher_id" value="{{$card->user->id}}">
                        <input type="hidden" name="term_id" value="{{$term->id}}">
                    </div>
                    <div class="form-group">
                        <label for="class_id">Class</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="{{$card->form->id}}">{{$card->form->form_name}}</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stream_id">Stream</label>
                        <select name="stream_id" id="stream_id" class="form-control">
                            <option value="{{($card->stream) ? $card->stream->id : ''}}">{{($card->stream) ? $card->stream->name : ''}}</option>
                            @foreach($school->streams as $stream)
                                <option value="{{$stream->id}}">{{$stream->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_id">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control" onchange="loadSubjectPapers($(this).val())">
                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                            @foreach($level->subjects as $subj)
                                <option value="{{$subj->id}}">{{$subj->subject_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    @if($card->paper)
                    <div class="form-group unhidden-subjectpapers" >
                        <label for="paper_id">Paper </label>
                        <select name="paper_id" id="paper_id" class="form-control">
                            <option value="{{$card->paper->id}}">{{$card->paper->name}}</option>
                            @foreach($subject->papers as $paper)
                                <option value="{{$paper->id}}">{{$paper->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group hidden subject-papers" id='subject-papers'>
                        
                    </div>
                    <div class="form-group">
                        <button type='submit' class="btn right btn-flat btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection