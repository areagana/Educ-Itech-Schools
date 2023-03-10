@Extends('schools.details')
@section('details')
<div class="container-fluid">
    <div class="row mx-1">
        <div class="col p-2">
            <form action="{{route('LevelUpdate',$level->id)}}" method='POST'>
                @csrf
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Name:</label>
                    </div>
                    <div class="col p-2">
                        <input type="text" name='level_name' class="form-control" value="{{$level->name}}" required>
                        <input type="hidden" name="school_id" value="{{$school->id}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 p-2">
                        <label for="">Grading:</label>
                    </div>
                    <div class="col p-2">
                        <select name="grading_level" id="grading_level" class="form-control">
                            <option value="{{$level->grading_level}}">{{$level->grade_level}}</option>
                            <option value="0">KG GRADING</option>
                            <option value="1">PRIMARY GRADING</option>
                            <option value="2">OLEVEL GRADING</option>
                            <option value="3">ALEVEL GRADING</option>
                        </select>
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