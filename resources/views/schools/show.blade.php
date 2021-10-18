@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schools')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <h3 class="header">LIST OF SCHOOLS</h3>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2 bg-white shadow-sm">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>School Name</th>
                            <th>Courses</th>
                            <th>Forms</th>
                            <th>Users</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sno=1;  @endphp
                        @foreach($schools as $school)
                            <tr class='school-info'>
                                <td>{{$sno++}}</td>
                                <td>{{$school->school_name}}</td>
                                <td>{{$school->courses->count('course_name')}}</td>
                                <td>{{$school->forms->count('form_name')}}</td>
                                <td>{{$school->users->count()}}</td>
                                <td>
                                    <a href="" class="nav-link"><i class="fa fa-book hidden hidden-icons" title='courses'></i></a>
                                    <a href="" class="nav-link"><i class="fa fa-address-card hidden hidden-icons" title='courses'></i></a>
                                </td>
                                <td>
                                    <span class="">
                                        <button class="btn btn-sm btn-light btn-circle btn-sm" onclick="ShowMore('school_more{{$school->id}}')"><i class="fa fa-ellipsis-v"></i></button>
                                        <div class="more absolute more-for-schools" id="school_more{{$school->id}}">
                                            <a href="{{route('schoolEdit',$school->id)}}" class="nav-link"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="{{route('schoolView',$school->id)}}" class="nav-link"><i class="fa fa-eye"></i> View</a>
                                            <a href="" class="nav-link"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection