@Extends('layouts.app')
@section('crumbs')

@endsection
@section('content')
    <div class="container-fluid p-2">
        <div class="row p-2 mx-2">
            <div class="col p-2 bg-white">
                <div class="header">Users
                    <span class="right inline-block p-3">
                        <!--<input type="text" class="form-control form-control-sm" id='searchUser' placeholder='Search...' onkeyup="SearchItem('searchUser','users-filter','tr')">-->
                    </span>
                    <span class="right inline-block">
                        <a href="" class="nav-link btn btn-default btn-sm">Export</a>
                        <a href="" class="nav-link btn btn-default btn-sm">Filter</a>
                    </span>
                </div>
                <div class="p-2">
                    <table class="table table-sm table-compressed data-table" id='dataTable'>
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>School</th>
                                <th>email</th>
                                <th>code</th>
                                <th>status</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="users-filter">
                            @foreach($users as $key=>$user)
                                @php
                                    $role = $user->roles->pluck('display_name')->toArray();
                                @endphp
                                @if(!$user->hasRole(['superadmnistrator','administrator']) && $user->school)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$user->firstName}} {{$user->lastName}}</td>
                                        <td>{{$user->school->school_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->barcode}}</td>
                                        <td>{{$user->account_status}}</td>
                                        <td>
                                            {{implode(',',$role)}}
                                        </td>
                                        <td>
                                            <a href="{{route('userView',$user->id)}}" class="nav-link" @popper(View)><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection