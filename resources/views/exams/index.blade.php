@Extends('layouts.schoolHome')
@section('crumbs')
@endsection
@section('schoolContent')
<div class="row mx-1">
    <div class="col p-2">
        <h3 class="p-2 border-bottom">{{$exam->term->term_name}} / {{$exam->exam_name}}
            <span class="right text-danger h5">
                {{(date_create($exam->lock_date) >= date_create(date('Y-m-d H:i:s'))) ? 'Deadline: '.date_format(date_create($exam->lock_date),'D jS M, Y') : 'Closed: '.date_format(date_create($exam->lock_date),'D jS M, Y') }}
            </span>
        </h3>
        <div class="mx-1 row">
            @foreach($exam->forms as $form)
                <div class="col p-2 bg-white m-2">
                    <h4 class="p-2 border-bottom">{{$form->form_name}}</h4>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection