@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 border border-primary">
                <div class="h2 p-2">Streams
                    <button class="btn btn-outline-success btn-flat btn-sm right" onclick="$('#new_stream').toggle('slow')"><i class="fa fa-plus-circle"></i> Stream</button>
                </div>
                <div class="p-2">
                    <table class="table table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                @if(Auth::user()->hasRole(['superadministrator','administrator']))
                                    <th>School</th>
                                @endif
                                <th></th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($streams as$key=> $stream)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$stream->name}}</td>
                                    @if(Auth::user()->hasRole(['superadministrator','administrator']))
                                        <td>{{$stream->school->school_name}}</td>
                                    @endif
                                    <td></td>
                                    <td>
                                        @if(Auth::user()->isAbleTo(['stream-edit']))
                                            <button class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></button>
                                        @endif
                                        @if(Auth::user()->isAbleTo(['stream-delete']))
                                            <button class="btn btn-sm btn-outline-info"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3 p-2 border-left hidden" id='new_stream'>
                <h3 class="border-bottom p-2">CREATE STREAM</h3>
                <form action="{{route('StoreStream')}}" method='POST'>
                    @csrf
                    @if(Auth::user()->hasRole(['superadministrator','administrator']))
                    <div class="form-group">
                        <label for="schools_id">School</label>
                        <select name="school_id" id="schools_id" class="custom-select">
                            <option value="">Select</option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->school_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="form-group border-bottom">
                        <input type="hidden" class="form-control" name='school_id' value="{{$school->id}}">
                        {{$school->school_name}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="">Stream Name</label>
                        <input type="text" name='name' class="form-control" id="stream_name" required>
                    </div>
                    <div class="form-row">
                        <div class="col p-2">
                            <button type='submit' class="btn btn-primary right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection