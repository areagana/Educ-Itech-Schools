@Extends('layouts.subjectview')
@section('crumbs')
    {{Breadcrumbs::render('subjectMember',$subject,$subject->id)}}
@endsection
@section('subjectContent')
<div class="container-fluid bg-white">
    <div class="h3 header">Members</div>
    <div class="row p-2">
        <div class="col-md-4 p-2">
            <select name="" id="filter-subject-members" class="custom-select" onchange="FilterMembers('filter-subject-members',{{$subject->id}})">
                <option value="All">All</option>
                <option value="student">Students</option>
                <option value="teacher">Teachers</option>
            </select>
        </div>
        <div class="col p-2">
            <input type="text" class="form-control" id="search-member" onkeyup="SearchItem('search-member','subject-people','tr')" placeholder='Search...'>
        </div>
    </div>
    <div class="row p-1">
        <div class="col p-2">
            <table class="table table-sm data-table" id='dataTable'>
                <thead class="table-info">
                    <tr>
                        <th>user_id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="subject-people">
                    @if($members->count() > 0)
                        @foreach($members as $key=> $member)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    <a href="" class="nav-link">{{$member->firstname}} {{$member->lastlame}}</a>
                                </td>
                                <td>{{$member->email}}</td>
                                <td>
                                   
                                </td>
                                <td>
                                    @if(Auth::user()->isAbleTo('user-edit'))
                                        <i class="fa fa-edit"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection