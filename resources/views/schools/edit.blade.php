@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schoolEdit',$school,$school->id)}}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row p-2">
        <div class="col p-2 bg-white shadow-sm">
            <h5 class="header">{{$school->school_name}}</h5>
            <div class="row p-3">
                <div class="col p-2">
                    <form action="{{route('SchoolUpdate')}}" method='POST' id='school-edit-form'>
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name='school_id' value="{{$school->id}}">
                            <label for="school_name" class="form-label">School Name</label>
                            <input type="text" class="custom-input" name='school_name' value="{{$school->school_name}}" id='school_name'>
                        </div>
                        <div class="form-group">
                            <label for="school_category" class="form-label">Category</label>
                            <select name="category_id" id="school_category" class="custom-input">
                                <option value="{{$school->category->id}}">{{$school->category->category_name}}</option>
                                @if(Auth::user()->isAbleTo('school-create'))
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school_code" class="form-label">School Code</label>
                            <input type="text" class="custom-input" name ='school_code' value="{{$school->school_code}}" id='school_code'>
                        </div>
                        <div class="form-group">
                            <label for="school_reg_no" class="form-label">School Reg No</label>
                            <input type="text" class="custom-input" name='school_reg_no' value="{{$school->reg_no}}" id='school_reg_no'>
                        </div>
                        <div class="form-group">
                            <label for="school_address" class="form-label">School Address</label>
                            <input type="text" class="custom-input" name='school_address'  value="{{$school->address}}" id='school_address'>
                        </div>
                        <div class="form-group">
                            <label for="school_email" class="form-label">School Email</label>
                            <input type="text" class="custom-input" name='school_email' value="{{$school->email}}" id='school_email'>
                        </div><div class="form-group">
                            <label for="school_contact" class="form-label">School Contact</label>
                            <input type="text" class="custom-input" name='school_contact' value="{{$school->contact}}" id='school_contact'>
                        </div><div class="form-group">
                            <label for="school_website" class="form-label">School Website</label>
                            <input type="text" class="custom-input" name='school_website_link' value="{{$school->website}}" id='school_website'>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 p-3">
                    <img src="{{asset('school-icon.png')}}" width="100%" height='320px'>
                    <div class="p-2">
                        <center>
                            <h4>{{$school->reg_no}}</h4>
                            <h3>{{$school->category->category_name}}</h3>
                            <p>{{$school->email}}</p>
                            <p><a href="{{$school->school_website_link}}" class="nav-link">{{$school->school_website_link}}</a></p>
                        </center>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-danger" onclick="Close('new-school')">Cancel</button>
                        <button class="btn btn-sm btn-primary right" type='submit' form='school-edit-form'>Update</button>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
