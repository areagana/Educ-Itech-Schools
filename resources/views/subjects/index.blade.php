@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
        <div class="p-2 bg-white">
            <div class="card p-2 border-primary">
                <h5 class="p-2 border-bottom border-primary">Subjects
                    <span class="right inline-block"> 
                        <input type="text" class="form-control form-control-sm" placeholder='Search...' id='searchSubject' onkeyup="SearchItem('searchSubject','school-subjects','tr')">
                    </span>
                </h5>
                <span class="text-muted"></span>
                <table class="table table-sm">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Subject Term</th>
                            <th>Users</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody id='school-subjects'>
                        @php $sno=1; @endphp
                        {{var_dump($subjects)}}
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="row p-1">
                <div class="col p-2">
                    {{$subjects->links()}}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection