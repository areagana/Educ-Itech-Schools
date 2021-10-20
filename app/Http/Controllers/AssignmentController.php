<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * gaccess the assignments page
     */
    public function index($id)
    {
        $subject = Subject::find($id);
        $school = $subject->course->school;
        // fetch basing on user role
        if(Auth::user()->hasRole(['teacher','administrator','ict-admin','student']))
        {
            $assignments = $subject->assignments;
        }
        return view('subjects.assignments.index',compact(['assignments','subject','school']));       
    }

    /**
     * create an assignment
     */
    public function create($id)
    {
        $subject = Subject::find($id);
        $assignment = new Assignment();
        $school = $subject->course->school;
        return view('subjects.assignments.create',compact(['subject','school']));
    }

    /**
     * store assignment
     */
    public function store(Request $request)
    {
        $assignment = new Assignment();
        $assignment->subject_id = $request->input('subject_id');
        $assignment->assignment_name = $request->input('assignment_title');
        $assignment->assignment_content = $request->input('assignment_content');
        $assignment->assignment_attachment = $request->input('assignment_content'); 
        $assignment->assignment_status = 'published';
        $assignment->start_date = $request->input('start_date');
        $assignment ->end_date = $request->input('deadline');
        $assignment->close_date = $request->input('close_date');
        $assignment->total_marks = $request->input('total_marks');
        $assignment->user_id = Auth::user()->id;
        $assignment->save();

        return redirect()->route('assignments',$request->input('subject_id'))->with('success','New assignment created successfully');
    }
}
