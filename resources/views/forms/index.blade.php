@Extends('schools.details')
@section('details')
    <div class="container-fluid bg-white">
        <div class="h5 border-bottom p-3">FORMS / CLASSES
            <span class="right" @popper(Add form) onclick="ShowDiv('new-form')">
                <button class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Form</button>
            </span>
        </div>
        <div class="row p-2">
            <div class="col p-2">
                <table class="table table-sm">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>code</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Students</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($school->forms as $key => $form)
                        <tr>
                            <td>{{++$key}}</td>
                            <td><a href="{{route('formView',$form->id)}}" class="nav-link">{{$form->form_code}}</a></td>
                            <td><a href="{{route('formView',$form->id)}}" class="nav-link">{{$form->form_name}}</a></td>
                            <td>{{$form->level->name}}</td>
                            <td>{{count($form->users)}}</td>
                            <td>
                                <span class="inline-block">
                                    <a href="{{route('FormEnroll',$form->id)}}" class="nav-link"><i class="fa fa-plus-circle" @popper(Add Users) title='Add Students'></i></a>
                                    @if(Auth::user()->isAbleTo('form-update'))
                                        <a href="{{route('FormEdit',$form->id)}}" class="nav-link"><i class="fa fa-edit" @popper(Edit)></i></a>
                                    @endif
                                    @if(Auth::user()->isAbleTo('form-delete'))
                                        <a href="{{route('FormDelete',$form->id)}}" class="nav-link"><i class="fa fa-trash" @popper(Delete)></i></a>
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 p-2 border-left hidden new-form" id='new_form'>
                <form action="{{route('formStore')}}" method='POST' id="new-classes-form">
                    @csrf
                    <div class="form-group row p-2">
                        <input type="hidden" name='school_id' value="{{$school->id}}">
                        <div class="col-md-3 p-2">
                            <label for="class_name" class="form-label">Class Name</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="custom-input" name='class_name' id='class_name' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-md-3 p-2">
                            <label for="class_code" class="form-label">Class Code</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="custom-input" name='class_code' id='class_code' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <div class="col-md-3 p-2">
                            <label for="class_code" class="form-label">Class Level</label>
                        </div>
                        <div class="col p-2">
                            <select name="form_level" id="form_level" class="custom-input" required>
                                    <option value="">Select</option>
                                @foreach($school->levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="btn btn-light btn-sm" onclick="$('#new_form').hide()">Cancel</button>
                            <button class="button btn btn-sm btn-primary right" type='submit' form='new-classes-form'>Submit</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection