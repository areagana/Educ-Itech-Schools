@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schools')}}
@endsection
@section('content')
    <div class="container-fluid bg-white shadow-sm p-2">
        <h3 class="header">SCHOOLS
            <span class="right h5">
                <input type="text" class="custom-input" id="school-search" placeholder='Search...'>
            </span>
        </h3>
        <div class="row">
            <div class="p-2 border border-light col">
                @foreach($schools as $school)
                <div class="inline-flex items-center mr-6 my-2 text-sm p-3">
                    <label for="{{$school->id}}">
                    <input type="checkbox" class="form-checkbox h-4 w-4" id="{{$school->id}}">
                    <span class="ml-2">{{$school->school_name}}</span>
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col p-2">
                <h5 class="header">New School</h5>
                <form action="{{route('schoolStore')}}" method='POST' id='new-school-form'>
                    @csrf
                    <div class="form-group">
                        <label for="school_name" class="form-label">School Name</label>
                        <input type="text" class="custom-input" name='school_name' id='school_name'>
                    </div>
                    <div class="form-group">
                        <label for="school_code" class="form-label">School Code</label>
                        <input type="text" class="custom-input" name='school_code' id='school_code'>
                    </div>
                    <div class="form-group">
                        <label for="school_reg_no" class="form-label">School Reg No</label>
                        <input type="text" class="custom-input" name='school_reg_no' id='school_reg_no'>
                    </div>
                    <div class="form-group">
                        <label for="school_address" class="form-label">School Address</label>
                        <input type="text" class="custom-input" name='school_address' id='school_address'>
                    </div>
                    <div class="form-group">
                        <label for="school_email" class="form-label">School Email</label>
                        <input type="text" class="custom-input" name='school_email' id='school_email'>
                    </div><div class="form-group">
                        <label for="school_contact" class="form-label">School Contact</label>
                        <input type="text" class="custom-input" name='school_contact' id='school_contact'>
                    </div><div class="form-group">
                        <label for="school_website" class="form-label">School Website</label>
                        <input type="text" class="custom-input" name='school_website_link' id='school_website'>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-danger">Cancel</button>
                        <button class="btn btn-sm btn-primary right" type='submit' form='new-school-form'>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection