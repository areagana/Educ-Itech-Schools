<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Form;
use App\Models\School;
use App\Models\Stream;
use Illuminate\Http\Request;

class MarksheetController extends Controller
{
    // allow authenticated users
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index($id)
    {
        $school = School::find($id);
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        return view('schools.marksheets.index',compact(['school','term']));
    }

    //generate marksheet
    public function markSheetview(Request $request)
    {
        $form_id = $request->input('form_id');
        $stream_id = $request->input('stream_id');
        $exam_id = $request->input('exam_id');
        $exam = Exam::find($exam_id);
        $form = Form::find($form_id);
        $stream = Stream::find($stream_id);
        $level = $form->level;
        $school = $form->school;
        $students = $form->students()->orderBy('firstname')->get();
        $term = $exam->term;
        // check level to redirect
        switch($level->name)
        {
            case "O'LEVEL":
                return view('schools.marksheets.olevel',compact(['exam','school','term','form','students','stream','level']))->with('task','Generate marksheet');
                break;
            case "A'LEVEL":
                return view('schools.marksheets.alevel',compact(['exam','school','term','form','students','stream','level']))->with('task','Generate marksheet');
                break;
        }
    }

    public function gdsheet($id)
    {
        $school = School::find($id);
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        return view('schools.gradesheets.index',compact(['school','term']));
    }

    public function gradeSheetview(Request $request)
    {
        $form_id = $request->input('form_id');
        $stream_id = $request->input('stream_id');
        $exam_id = $request->input('exam_id');
        $exam = Exam::find($exam_id);
        $form = Form::find($form_id);
        $stream = Stream::find($stream_id);
        $level = $form->level;
        $school = $form->school;
        $students = $form->students()->orderBy('firstname')->get();
        $term = $exam->term;
        // check level to redirect
        switch($level->name)
        {
            case "O'LEVEL":
                return view('schools.gradesheets.olevel',compact(['exam','school','term','form','students','stream','level']))->with('task','Generate marksheet');
                break;
            case "A'LEVEL":
                return view('schools.gradesheets.alevel',compact(['exam','school','term','form','students','stream','level']))->with('task','Generate marksheet');
                break;
        }
    }

}
