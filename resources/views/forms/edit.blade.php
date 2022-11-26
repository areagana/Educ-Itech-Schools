@Extends('layouts.schoolHome')
@section('crumbs')
@endsection
@section('schoolContent')
<div class="row p-2">
    <div class="col p-2 m-2 bg-white border border-primary">
        <h3 class="p-2 border-bottom">{{$form->form_name}} - Edit</h3>
        <div class="row mx-1">
            <div class="col p-2">
                <form action="{{route('formUpdate',$form->id)}}" method='POST' id="new-classes-form">
                    @csrf
                    <div class="form-group row p-2">
                        <div class="col-md-3 p-2">
                            <label for="class_name" class="form-label">Class Name</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="custom-input" name='form_name' id='class_name' value="{{$form->form_name}}" autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-md-3 p-2">
                            <label for="class_code" class="form-label">Class Code</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="custom-input" name='form_code' value="{{$form->form_code}}"  id='class_code' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-md-3 p-2">
                            <label for="class_code" class="form-label">Class Level</label>
                        </div>
                        <div class="col p-2">
                            <select name="form_level" id="form_level" class="custom-input" required>
                                    <option value="{{$form->level->id}}" >{{$form->level->name}}</option>
                                @foreach($school->levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="button btn btn-sm btn-primary right" type='submit' form='new-classes-form'>Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 p-2 border-left">
                <h4 class="p-2 border-bottom">{{$form->form_name}} - Streams</h4>

                <div class="p-">
                    @if($form->streams->count() > 0)
                        @foreach($form->streams as $stream)
                        <div class="p-2 mx-4">
                            <input type="checkbox" name="form_stream[]" id="stream{{$stream->id}}" class="form-check-input" checked>
                            <label for="stream{{$stream->id}}">{{$stream->name}}</label>
                        </div>
                        @endforeach
                    @endif
                    <div class="p-2 border-bottom h4">Add Stream</div>
                    <form action="{{route('FormSync',$form->id)}}" method='POST'>
                        @csrf
                        @foreach($streams as $stream)
                            <div class="p-2 mx-4">
                                <input type="checkbox" name="form_stream[]" id="streamadd{{$stream->id}}" value="{{$stream->id}}" class="form-check-input" {!!$stream->assigned ? 'checked': ''!!}>
                                <label for="streamadd{{$stream->id}}">{{$stream->name}}</label>
                            </div>
                        @endforeach
                        <div class="row mx-2 border-top">
                            <div class="col p-2">
                                <button type="submit" class="btn btn-flat btn-sm btn-primary right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection