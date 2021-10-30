<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\School;
use App\Models\User;
use App\Models\Module;

class SubjectController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $subjects = $school->subjects()->paginate(10);
        return view('subjects.index',compact(['school','subjects']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->form_id = $request->input('class_id');
        $subject->term_id = $request->input('class_id');
        $subject->course_id = $request->input('course_id');
        $subject->subject_name = $request->input('subject_name');
        $subject->subject_code = $request->input('subject_code');
        $subject->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $subjects = Auth::user()->subjects;
        return view('subjects.show',compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * enroll students into a subject
     */
    public function enrollStudents($id)
    {
        $subject = Subject::find($id);
        $school = $subject->course->school;
        $students = $subject->form->users()->whereRoleIs('student')->sortable()->paginate(10);
        return view('subjects.subject_enroll',compact(['subject','school','students']));
    }

    /**
     * enroll students into a subject
     */
    public function enrollStudentsstore(Request $request)
    {
        $id = $request->input('subject_id');
        $subject = Subject::find($id);
        $students = $request->input('selected_student');
        foreach($students as $sid)
        {
            $student = User::find($sid);
            if(!$student->subjects->find($subject))
            {
                $student->subjects()->attach($subject);
            }
        }
        return redirect()->route('subjectMembers',$subject->id);
    }

    /**
     * get subject members
     */
    public function members($id)
    {
        $subject = Subject::find($id);
        $school = $subject->course->school;
        return view('subjects.members',compact(['subject','school']));
    }

    /**
     * get subject details for the user
     */
    public function subjectDetails($id)
    {
        $subject = Subject::find($id);
        $date = date('Y-m-d');
        $upcoming = $subject->assignments()->whereDate('end_date','>=',$date)->get();
        $previous = $subject->assignments()->whereDate('end_date','<',$date)->get();
        return view('subjects.view',compact(['subject','upcoming','previous']));
    }

    /**
     * functions to access subject content
     */
    public function people($id)
    {
        $subject = Subject::find($id);
        $members = $subject->users;
        $school = $subject->course->school;
        return view('subjects.people.index',compact(['subject','members','school']));
    }

    /**
     * notes
     */
    public function notes($id)
    {   
        $subject = Subject::find($id);
        $modules = $subject->modules;
        return view('subjects.notes.index',compact(['modules','subject']));
    }

    /**
     * grades
     */
    public function grades($id)
    {
        $subject = Subject::find($id);
        if(Auth::user()->hasRole('student'))
        {
            $assignments = $subject->assignments;
            $total_points = $assignments->sum('total_points');
            $total_marks = Auth::user()->assignment_submissions()->sum('submitted_grade');
            return view('subjects.grades.studentGrade',compact(['subject','assignments','total_points','total_marks']));
        }else{
            return view('subjects.grades.gradebook',compact(['subject']));
        }
    }

    /**
     * conferences
     */
    public function conferences($id)
    {
        $subject = Subject::find($id);
        $conferences = $subject->conferences;
        return view('subjects.conferences.index',compact(['subject','conferences']));
    }

    /**
     * Announcememts
     */
    public function announcements($id)
    {
        
    }

    /**
     * files
     */
    public function files($id)
    {
        
    }

    /**
     * filter subject members
     */
    public function filterMembers(Request $request)
    {
        if($request->ajax())
        {
            $role = $request->role;
            if($role !='All')
            {
                $subject_id = $request->subject;
                $subject = Subject::find($subject_id);
                $members = $subject->users()->whereRoleIs($role)->get();
            }else{
                $subject_id = $request->subject;
                $subject = Subject::find($subject_id);
                $members = $subject->users;
            }
            $roles=[];
            foreach($members as $member)
            {
                $roles = $member->roles;
            }
            return response()->json(['data'=>$members]);
        }
    }
}
