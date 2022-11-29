@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="p-2 bg-white">
                    <div class="card p-2 border-primary">
                        <h5 class="p-2 border-bottom border-primary">Subjects
                            <span class="right inline-block"> 
                                <button class="btn btn-outline-primary btn-sm" onclick='$("#new_subject").toggle("slow")'><i class="fa fa-plus"></i> Add</button>
                            </span>
                        </h5>
                        <span class="text-muted"></span>
                        <table class="table table-sm data-table">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Short</th>
                                    <th>Level</th>
                                    <th>Students</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody id='school-subjects'>
                                @foreach($school->subjects as $key=>$subject)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$subject->subject_code}}</td>
                                        <td>{{$subject->subject_name}}</td>
                                        <td>{{$subject->short_name}}</td>
                                        <td>{{$subject->level->name}}</td>
                                        <td>{{$subject->students()->count()}}</td>
                                        <td>
                                            @if($term)
                                            <span class="inline-block">
                                                <a href="{{route('SubjectEnroll',$subject->id)}}" class="btn btn-sm btn-outline-info" @popper(Add Students)><i class="fa fa-plus"></i> Students</a>
                                                <a href="{{route('subjectMembers',$subject->id)}}" class="nav-link btn btn-sm btn-light btn-circle" @popper(View List)><i class="fa fa-eye"></i></a>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach                     
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col p-2 hidden" id='new_subject'>
                <h3 class="p-2 border-bottom bg-white">New Subject</h3>
                <form action="{{route('subjectStore')}}" method='POST'>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Name:</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name='subject_name' class="form-control" required>
                            <input type="hidden" name="school_id" value="{{$school->id}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Code:</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name='subject_code' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Short:</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name='short_name' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Level</label>
                        </div>
                        <div class="col p-2">
                            <select name="subject_level" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach($school->levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Papers</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name='subject_papers' class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row border-bottom">
                        <div class="col p-2">
                            <button type='submit' class="btn btn-primary right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection