@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 border border-primary">
                <h3 class='p-2 border-bottom'>{{$subject->subject_name}} - Topics
                    <span class="right">
                        <button class="btn btn-sm btn-outline-primary" onclick="$('.new_topic').toggle('slow')"><i class="fa fa-plus-circle"></i> Topic</button>
                    </span>
                </h3>
                <div class="row mx-1">
                    <div class="col p-2 bg-white">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Term</th>
                                    <th>Form</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topics as $key=> $topic)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td><a href="{{route('topicUpdate',[$card->id,$topic->id])}}" class="nav-link">{{$topic->name}}</a></td>
                                    <td>{{$topic->term->term_name}}</td>
                                    <td>{{$topic->form->form_name}}</td>
                                    <td>
                                        {{$topic->records()->count()}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 p-2 hidden new_topic">
                        <h3 class="p-3 border-bottom">{{$subject->subject_name}} - New Topic</h3>
                        <div class="p-2">
                            <form action="{{route('topicSave')}}" method='POST'>
                                @CSRF
                                <div class="form-group">
                                    <label for="">Topic Name</label>
                                    <input type="text" name='topic_name' class="form-control" id="topic_name" required>
                                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                    <input type="hidden" name="form_id" value="{{$card->form->id}}">
                                </div>
                                <div class="form-group">
                                    <button type='submit' class="btn btn-flat btn-info">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection