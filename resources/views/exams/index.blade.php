@Extends('layouts.schoolHome')
@section('crumbs')
    {{Breadcrumbs::render('Examname',$exam,$school)}}
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
                    @foreach($form->level->subjects as $subject)
                        @php
                            $records = $form->examresults()->where('exam_id',$exam->id)->where('subject_id',$subject->id)->count();
                        @endphp
                        @if($subject->papers()->count() > 1)
                            <div id="accordion" class='mt-1'>
                                <div class="card">
                                    <div class="card-header" id="subject{{$subject->id}}">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link" data-toggle="collapse" data-target="#subj{{$form->id}}{{$subject->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                {{$subject->short_name}}
                                                <span class="right">
                                                    {{$records}}
                                                </span>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="subj{{$form->id}}{{$subject->id}}" class="collapse" aria-labelledby="subject{{$subject->id}}e" data-parent="#accordion">
                                        <div class="card-body">
                                            @for($i=1;$i<=$subject->papers()->count();$i++)
                                                <div class="p-2 border-bottom">
                                                    P{{$i}}
                                                    <span class="right">
                                                        {{$records}}
                                                    </span>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-2 border-bottom">
                                <a href="{{route('adminUpdate',[$exam->id,$form->id,$subject->id])}}" class="nav-link p-0">
                                    {{$subject->short_name}}
                                    <span class="right">{{$records}}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection