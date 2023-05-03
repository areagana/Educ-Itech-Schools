@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('addSchool')}}
@endsection
@section('content')
<div class=" p-2">
    <div class="row p-2 mx-2">
        <div class="col p-2 bg-white ">
            <h4 class="header ">New School</h4>
                <form action="{{route('schoolStore')}}" method='POST' id='new-school-form' enctype='multipart/form-data'>
                    @csrf
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_name" class="form-label">School Name</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_name' value="{{isset($school) ? $school->school_name: ''}}" id='school_name'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_category" class="form-label">Category</label>
                            </div>
                            <div class="col p-2">
                                <select name="category_id" id="school_category" class="form-control">
                                    <option value="">Select</option>
                                    @if(Auth::user()->isAbleTo('school-create'))
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_code" class="form-label">School Code</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name ='school_code' value="" id='school_code'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_reg_no" class="form-label">School Reg No</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_reg_no' value="" id='school_reg_no'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_address" class="form-label">School Address</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_address'  value="" id='school_address'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_emisno" class="form-label">Emis No</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='emis_no'  id='school_emisno'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_email" class="form-label">School Email</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_email' value="" id='school_email'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_contact" class="form-label">School Contact</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_contact' value="" id='school_contact'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_website" class="form-label">School Website</label>
                            </div>
                            <div class="col p-2">
                                <input type="text" class="form-control" name='school_website_link' value="" id='school_website'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_logo" class="form-label">Logo</label>
                            </div>
                            <div class="col p-2">
                                <input type="file" class="form-control" name='school_logo' value="" id='school_logo'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 p-2">
                                <label for="school_watermark" class="form-label">Water Mark</label>
                            </div>
                            <div class="col p-2">
                                <input type="file" class="form-control" name='school_watermark' value="" id='school_watermark'>
                            </div>
                        </div>
                </form>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-danger" onclick="Close('new-school')">Cancel</button>
                        <button class="btn btn-sm btn-primary right" type='submit' form='new-school-form'>Submit</button>
                    </div>
                </div>
        </div>
        <div class="col p-2">
            <h3>MORE SCHOOL INFO</h3>
        </div>
    </div>
</div>
@endsection
