@Extends('schools.details')
@section('details')
    <div class="container-fluid bg-white">
        <div class="h5 border-bottom p-3">FORMS / CLASSES
            <span class="right bg-info p-2 h6" @popper(Add form) onclick="ShowDiv('new-form')">
                <i class="fa fa-plus"></i> Form
            </span>
        </div>
        <div class="row p-2">
            <div class="col p-2">
                <div class="h6 header">Active Classes</div>
                <table class="table table-sm">
                    <thead class="table-info">
                        <tr>
                            <th>code</th>
                            <th>Name</th>
                            <th>Members</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($school->forms as $form)
                        <tr>
                            <td>{{$form->form_code}}</td>
                            <td>{{$form->form_name}}</td>
                            <td>{{count($form->users)}}</td>
                            <td>
                                <span class="inline-block">
                                    <a href="{{route('FormEnroll',$form->id)}}" class="nav-link"><i class="fa fa-plus-circle" @popper(Add Users) title='Add Students'></i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-trash" @popper(Delete)></i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-edit" @popper(Edit)></i></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 p-2 border-left hidden new-form">
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
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="button btn btn-sm btn-primary right" type='submit' form='new-classes-form'>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection