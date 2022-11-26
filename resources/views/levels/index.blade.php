@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="p-2 bg-white">
                    <div class="card p-2 border-primary">
                        <h5 class="p-2 border-bottom border-primary">Levels
                            <span class="right inline-block"> 
                                <button class="btn btn-outline-primary btn-sm" onclick='$("#new_subject").toggle("slow")'><i class="fa fa-plus"></i> Add</button>
                            </span>
                        </h5>
                        <span class="text-muted"></span>
                        <table class="table table-sm">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>Level Name</th></th>
                                    <th>Classes</th>
                                    <th>Subjects</th>
                                    <th>Users</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody id='school-subjects'>
                                @foreach($school->levels as $key=>$level)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$level->name}}</td>
                                        <td>{{$level->forms->count()}}</td>
                                        <td>{{$level->subjects->count()}}</td>
                                        <td></td>
                                        <td>
                                            @if($term)
                                            <span class="inline-block">
                                                <a href="{{route('LevelEdit',$school->id,$level->id)}}" class="nav-link btn btn-sm btn-light btn-circle" @popper(Add Users)><i class="fa fa-edit"></i></a>
                                                <a href="{{route('LevelDelete',$level->id)}}" class="nav-link btn btn-sm btn-light btn-circle" @popper(View List)><i class="fa fa-trash"></i></a>
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
                <h3 class="p-2 border-bottom bg-white">New Level</h3>
                <form action="{{route('LevelStore',$school->id)}}" method='POST'>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-2 p-2">
                            <label for="">Name:</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name='level_name' class="form-control" required>
                            <input type="hidden" name="school_id" value="{{$school->id}}">
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