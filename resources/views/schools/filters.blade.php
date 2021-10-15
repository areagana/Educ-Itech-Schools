@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2">
                    Filters::
                    <span class="inline-block">
                        @foreach($school->forms as $form)
                            {{$form->form_name}}
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection