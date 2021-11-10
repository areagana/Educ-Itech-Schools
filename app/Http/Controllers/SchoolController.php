<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;

class SchoolController extends Controller
{
    
    /**
     * check authentication
     */
    public function __construct()
    {
        return $this->middleware(['auth','role:superadministrator|administrator|ict-admin|school-admnistrator']);
    }

    /**
     * access schools
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole(['superadministrator','administrator']))
        {
            $schools = School::paginate(6);
            return view('schools.show',compact('schools'));
        }
        return redirect()->back();
    }

    /**
     * redirect to creating new school page
     */

     public function create()
     {
         $school = new School();
         return view('schools.create');
     }

     /**
      * edit school details
      */
      public function edit($id)
      {
          $school = School::find($id);
          return view('schools.edit',compact(['school']));
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
     * update school information
     */
    public function update(Request $request)
    {
        $id = $request->input('school_id');
        $school = School::find($id);

        $school->school_name = $request->input('school_name');
        $school->school_code = $request->input('school_code');
        $school->reg_no = $request->input('school_reg_no');
        $school->email = $request->input('school_email');
        $school->address = $request->input('school_address');
        $school->main_contact = $request->input('school_contact');
        $school->school_code = $request->input('school_website_link');
        $school->user_id = Auth::user()->id;
        $school->save();
        return redirect('/schools')->with('success',$school->school_name.' Updated successfully');
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

    /**
     * load school details
     */
    public function Details($id)
    {
        $school = School::find($id);
        $term = $school->terms()->latest()->first();
        return view('schools.home',compact(['school','term']));
    }
    

    /**
     * get school students
     */
    public function students($id)
    {
        //check user roles
        $user = Auth::user();
        if($user->hasRole(['superadministrator','administrator']))
        {
            $school = School::find($id);
            $term = $school->terms()->latest()->first();
            $students = User::where('school_id',$id)
                        ->whereRoleIs('student')
                        ->paginate(10);
            
                        return view('students.index',compact(['school','students','term']));
            /**
             * allow this for only administrators and super administrators
             */
        }else if($user->hasRole(['ict-admin','school-administrator'])){
            
            $school = $user->school;
            $term = $school->terms()->latest()->first();
            $students = User::where('school_id',$school->id)
                        ->whereRoleIs('student')
                        ->paginate(20);

            return view('students.index',compact(['school','students','term']));
            /**
             * this is allowed for only school leaders including ict-admin
             */
        }else{
            return redirect()->back();
        }
    }

    /**
     * find school
     */
    public function school($id)
    {
        $school = School::find($id);
        return $school;
    }

    /**
     * find teachers
     */

    public function SchoolTeachers($id)
    {
        $user= Auth::user();
        if($user->hasRole(['administrator','superadministrator']))
        {
            $school = School::find($id);
            $term = $school->terms()->latest()->first();
            $teachers = $school->users()->whereRoleIs('teacher')->paginate(10);
        }else if($user->hasRole(['ict-admin','school-administrator']))
        {
            $school = $user->school;
            $term = $school->terms()->latest()->first();
            $teachers = $school->users()->whereRoleIs('teacher')->paginate(10);
        }
        return view('teachers.index',compact(['school','teachers','term']));
    }
}
