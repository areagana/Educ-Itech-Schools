@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2">
                    <div class="h4 bg-info border-bottom border-primary p-2">{{$subject->subject_name}} <i class="fa fa-angle-right h5"></i> members
                        <span class="right">
                            <input type="text" class="form-control form-control-sm" id='searchSubjectMember' placeholder='Search...'  onkeyup="SearchItem('searchSubjectMember','subject_members','tr')">
                        </span>
                    </div>
                    <div class="p-2 border border-primary">
                        <table class="table table-sm">
                            <thead class="table-info">
                                <tr>
                                    <th>
                                        <input type="checkbox" name="select_all" class='' id="select_all" onclick="toggle(this)">
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id='subject_members'>
                                @foreach($subject->students as $member)
                                    <tr>
                                        <td><input type="checkbox" name="selected_student[]" id="selected_student{{$member->id}}" value="{{$member->id}}" class='form-check-input mx-1'></td>
                                        <td>{{$member->firstname}} {{$member->lastname}}</td>
                                        <td>{{$member->email}}</td>
                                        <td><i class="fa fa-trash btn btn-sm btn-light btn-circle" onclick="xdialog.confirm('Remove user from subject?',function(){})" @popper(Remove User) title='Remove User'></i></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection