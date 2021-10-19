@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row p-2">
        <div class="col p-2">
            DASHBOARD
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col p-2 dash-card bg-white shadow-sm m-2">
            Schools <span class="right"><i class="fa fa-school text-info"></i></span><br>
            {{$schools->count()}}
        </div>
        <div class="col p-2 dash-card shadow-sm m-2 bg-info">
            Users <span class="right"><i class="fa fa-users text-white"></i></span><br>
            {{array_sum($users)}}
        </div>
        <div class="col p-2 dash-card shadow-sm m-2 bg-success">
            Courses <span class="right"><i class="fa fa-book text-white"></i></span><br>
            {{array_sum($courses)}}
        </div>
    </div>
</div>
@endsection
