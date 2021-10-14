@Extends('schools.details')
@section('details')
    <div class="container-fluid bg-white">
        <div class="h5 border-bottom p-3">FORMS / CLASSES</div>
        <div class="row p-2">
            <div class="col p-2">
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
            <div class="col-md-4 p-2 border-left">
                <div class="h6 header">Active Classes</div>
                @foreach($school->forms as $form)
                    <li class='nav-item'>{{$form->form_name}}</li>
                @endforeach
            </div>
        </div>
    </div>
@endsection