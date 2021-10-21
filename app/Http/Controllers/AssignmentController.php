<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\SubmissionComment;

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
     * show assignments
     */
    public function show($id1,$id2)
    {
        $subject = Subject::find($id1);
        $assignment = Assignment::find($id2);
        $school = $subject->course->school;
        return view('subjects.assignments.show',compact(['subject','school','assignment']));
    }

    /**
     * attempt an assignment
     */
    public function attempt($id1,$id2)
    {
        $subject = Subject::find($id1);
        $assignment = Assignment::find($id2);
        $school = $subject->course->school;
        return view('subjects.assignments.attempt',compact(['subject','assignment','school']));
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

    /**
     * students uploading assignments with attachments
     */
    public function storeSubmitted(Request $request)
    {
        
        /*$request->validate([
            'assignment_attachment'=>'mimes:ppt,pptx,docs,docx,pdf,jpeg,png'
        ]);*/

        $reference = $request->get('reference');
        $id = $request->input('subject_id');
        $subject = Subject::find($id);

        $files=[];
        if($request->file('assignment_attachment'))
        {
            foreach($request->file('assignment_attachment') as  $file)
            {
                $fileName =time().'_'.$file->getClientOriginalName();
                $file->move(public_path('Assignments/submissions/'.$reference),$fileName);
                $files[] = $fileName;
            }
        }
        
        $assignment = Assignment::find($request->input('assignment_id'));
        $submission = new AssignmentSubmission();
        $submission->user_id = Auth::user()->id;
        $submission->assignment_id = $request->input('assignment_id');
        $submission->attachment_link = json_encode($files);
        $submission->submitted_status = ' Submitted';
        $submission->save();

        if(!empty($request->input('assignment_comment')))
        {
            $comment = new SubmissionComment();
            $comment->user_id = Auth::user()->id;
            $comment->assignment_submission_id = $submission->id;
            $comment ->comment = $request->input('assignment_comment');
            $comment->save();
        }
        
        return redirect()->back()->with('success','Assignment submitted successfully');
    }
}
