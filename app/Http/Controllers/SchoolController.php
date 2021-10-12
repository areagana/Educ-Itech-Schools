<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class SchoolController extends Controller
{
    
    
    /**
     * check authentication
     */
    public function __construct()
    {
        return $this->middleware(['auth','role:superadministrator']);
    }

    /**
     * access schools
     */
    public function index()
    {
        $schools = School::paginate(6);
        return view('schools.index',compact('schools'));
    }

    /**
     * store new school information
     */
    public function store(Request $request)
    {
        $school = new School();
        $school->school_name = $request->input('school_name');
        $school->school_code = $request->input('school_code');
        $school->reg_no = $request->input('school_reg_no');
        $school->email = $request->input('school_email');
        $school->address = $request->input('school_address');
        $school->main_contact = $request->input('school_contact');
        $school->school_code = $request->input('school_website_link');
        $school->user_id = Auth::user()->id;
        $school->save();
        return redirect()->back()->with('success',$school->school_name.' registered successfully');
    }

    /**
     * find school name and details basing on the selection
     */
    public function find(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $school = School::find($id);
            $school_courses = $school->courses()->get();
            //$school_users = $school->users->get()->orderBy('firstName','ASC');

        return response()->json(['courses'=>$school_courses,'schools'=>$school]);
        }
    }
}
