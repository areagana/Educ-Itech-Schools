<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;
use App\Models\Category;

class SchoolController extends Controller
{
    
    /**
     * check authentication
     */
    public function __construct()
    {
        return $this->middleware(['auth','role:superadministrator|administrator|ict-admin|school-administrator']);
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

        // check school classes
        return redirect()->back();
    }

    /**
     * redirect to creating new school page
     */
    public function checkme()
    {
        // return view('welcome');
        $school = new School();
         $categories = Category::all();
         return view('schools.create2',compact('categories'));
    }
    //  public function create()
    //  {
    //      $school = new School();
    //      $categories = Category::all();
    //      return view('schools.create2',compact('categories'));
    //  }

     /**
      * edit school details
      */
      public function edit($id)
      {
          $school = School::find($id);
          $categories = Category::all();
          return view('schools.edit',compact(['school','categories']));
      }
    /**
     * store new school information
     */
    public function store(Request $request)
    {
        $school = new School();
        $school->school_name = $request->input('school_name');
        $school->category_id = $request->input('school_category');
        $school->school_code = $request->input('school_code');
        $school->reg_no = $request->input('school_reg_no');
        $school->email = $request->input('school_email');
        $school->emis_no = $request->input('emis_no');
        $school->school_logo = $request->input('school_logo');
        $school->water_mark = $request->input('water_mark');
        $school->address = $request->input('school_address');
        $school->main_contact = $request->input('school_contact');
        $school->school_website_link = $request->input('school_website_link');
        $school->user_id = Auth::user()->id;
        $school->save();

        // create a folder for the school data
        mkdir(storage_path('app/public'.'/'.$school->school_name));

        mkdir(storage_path('resources/reports/footers/'.$school->reg_no.'.blade.php'));
        mkdir(storage_path('resources/reports/headers/'.$school->reg_no.'.blade.php'));

        // redirect to schoollevels ceation
        return redirect()->route('schoolLevels',$school->id);
        // return redirect()->back()->with('success',$school->school_name.' registered successfully');
    }


    /**
     * update school information
     */
    public function update(Request $request)
    {
        $id = $request->input('school_id');
        $school = School::find($id);
        $school->category_id = $request->input('category_id');
        $school->school_name = $request->input('school_name');
        $school->school_code = $request->input('school_code');
        $school->reg_no = $request->input('school_reg_no');
        $school->email = $request->input('school_email');
        $school->address = $request->input('school_address');
        $school->main_contact = $request->input('school_contact');
        $school->school_website_link = $request->input('school_website_link');
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
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();

        if($school->forms()->count() ==0 ){
            return redirect()->route('schoolForms',$school->id);
        }
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
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
            $students = User::where('school_id',$id)
                        ->whereRoleIs('student')
                        ->paginate(10);
            
                        return view('students.index',compact(['school','students','term']));
            /**
             * allow this for only administrators and super administrators
             */
        }else if($user->hasRole(['ict-admin','school-administrator'])){
            
            $school = $user->school;
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
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
     * school levels
     */
    public function levels()
    {
        $level = new Level;
        return view('levels.index');
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
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
            $teachers = $school->users()->whereRoleIs('teacher')->paginate(10);
        }else if($user->hasRole(['ict-admin','school-administrator']))
        {
            $school = $user->school;
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
            $teachers = $school->users()->whereRoleIs('teacher')->paginate(10);
        }
        return view('teachers.index',compact(['school','teachers','term']));
    }

    /**
     * access assessments
     */
    public function assessments($id)
    {
        $school = School::find($id);
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->with('exams')
                                ->first();
        $exams = $school->exams()->orderByDesc('id')->get();
        return view('schools.assessments',compact(['school','term','exams']));
    }
}
