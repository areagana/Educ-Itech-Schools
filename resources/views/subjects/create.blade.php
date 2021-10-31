@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('subjects',$course,$course->school,$course->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 bg-white">
                <h3 class="header">SUBJECTS</h3>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2 bg-white">
                @if(!empty($term->items))
                <form action="{{route('subjectStore')}}" method='POST' id="class_subject_form">
                    @csrf
                    <div class="form-group row p-2">
                        <input type="hidden" name='term_id' value='{{$term->id}}'>
                        <input type="hidden" name='course_id' value="{{$course->id}}">
                        <div class="col p-1">
                            <label for="class_name" class="form-label">Class Name:</label>
                        </div>
                        <div class="col-md-8 p-2">
                           <select name="class_id" id="" class="custom-input p-2">
                               <option value="" hidden>Select</option>
                               @foreach($course->school->forms as $form)
                                    <option value="{{$form->id}}">{{$form->form_name}}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col p-1">
                            <label for="subject_name" class="form-label">Subject Name:</label>
                        </div>
                        <div class="col-md-8 p-2">
                            <input type="text" id='subject_name' name='subject_name' value="{{$course->course_name}}" class="custom-input p-2" >
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col p-1">
                            <label for="subject_code" class="form-label"> Subject Code:</label>
                        </div>
                        <div class="col-md-8 p-2">
                            <input type="text" id='subject_code' name='subject_code' class="custom-input p-2" >
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col p-1">
                            <button class="btn btn-sm btn-primary right" type='submit'>Submit</button>
                        </div>
                    </div>
                </form>
                @else
                    <div class="p-2 border border-primary">
                        <i>No subjects can be created when no term is running.
                            <p>School term has to be set first.</p>
                        </i>
                    </div>
                @endif
            </div>
            <div class="col-md-3 p-2 border-left bg-white ml-1">
                <div class="h4 header">Active subjects</div>
                @if(!empty($term->items))
                    @foreach($term->subjects as $subject)
                        <li class='nav-item'>{{$subject->subject_code}}  {{$subject->subject_name}}</li>
                    @endforeach
                @else
                    <div class="p-2 border border-info">
                        <i>No Subjects created for this term</i>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection