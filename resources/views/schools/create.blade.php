@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('newSchool')}}
@endsection
@section('content')
<div class="">
    <div class="row p-2">
        <div class="col p-2 bg-white shadow-sm">
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
                        <label for="school_category" class="form-label">School Category</label>
                        <select name="school_category" id="school_category" class="custom-input">
                            <option value="">Select</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
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
                        <button class="btn btn-sm btn-danger" onclick="Close('new-school')">Cancel</button>
                        <button class="btn btn-sm btn-primary right" type='submit' form='new-school-form'>Submit</button>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
