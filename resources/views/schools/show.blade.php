@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schools')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <h3 class="header p-3">LIST OF SCHOOLS</h3>
            </div>
        </div>
        <div class="row mx-2 p-2 border border-primary">
            <div class="col p-2 inline-block table-responsive">
                <table class="table table-sm table-responsive" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Users</th>
                            <th>Students</th>
                            <th>Reg No</th>
                            <th>Emis no</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($schools as $key=> $school)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <a href="{{route('schoolView',$school->id)}}" class="nav-link">{{$school->school_name}}</a></td>
                            <td>{{$school->users()->count()}}</td>
                            <td>{{$school->students()->count()}}</td>
                            <td>{{$school->reg_no}}</td>
                            <td>{{$school->emis_no}}</td>
                            <td>{{$school->email}}</td>
                            <td>{{$school->main_contact}}</td>
                            <td>
                                <a href="{{route('schoolEdit',$school->id)}}" class="btn btn-sm btn-outline-info ">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection