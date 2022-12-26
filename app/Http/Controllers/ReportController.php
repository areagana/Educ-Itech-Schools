<?php

namespace App\Http\Controllers;
use PDF;
use Dompdf\Dompdf;
use App\Models\Exam;
use App\Models\Form;
use App\Models\Role;
use App\Models\School;
use App\Models\Stream;
use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Allow authenticated users withleadership roles
     */
    public function __construct()
    {
        return $this->middleware(['auth','role:superadministrator|administrator|school-administrator|ict-admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        return view('reports.adminView',compact(['school','term']));
    }

    /**
     * fetch student report
     */
    public function studentReport()
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        $school = $user->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();

        if($term)
        {
            $subjects = $user->subjects()->where('term_id',$term->id)->get();
        }else{
            $subjects = "";
        }
        $form = $user->forms()->latest()->first();

        return view('reports.studentView',compact(['user','school','subjects','form','term']));
    }

    public function studentReportPDF()
    {
        $user = Auth::user();
        $school = $user->school;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        
        if($term)
        {
            $subjects = $student->subjects;
        }else{
            $subjects = "";
        }
        $form = $student->form;

        view()->share('reports.PDFStudent',[$student,$school,$subjects,$form]);
        $pdf = PDF::loadView('reports.PDFStudent',['student'=>$student,'school'=>$school,'subjects'=>$subjects,'form'=>$form]);
  
        // download PDF file with download method
        return $pdf->download($user->firstname.' '.$user->lastname.'.pdf');
        //return view('reports.studentView',compact(['user','school','subjects','form']));
    }

    /**
     * marksheets
     */
    public function marksheetView($id)
    {
        // check school level
        $exam = Exam::find($id);
        $school = $exam->school;
        $category = $school->category->category_name;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        
        switch($category)
        {
            case('Primary School'):
                return view('schools.marksheets.primary',compact('school','exam','term'));
                break;
            case('Secondary School'):
                return view('schools.marksheets.olevel',compact('school','exam','term'));
                break;
            case(''):
                return view('schools.marksheets.alevel',compact('school','exam','term'));
                break;
        }
    }

    /**
     * load marksheet for class
     */
    public function loadMarksheet(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->form;
            $exam = $request->exam;
            $term = Exam::find($exam)->term;
            $form = Form::find($id);
            $subjects = $form->level()->subjects->toArray();
            $results = $form->examresults()->where('exam_id',$exam)->get();
            // load users along side the results generated
            $students_all =[];
            
            $subs =[];
            foreach($results as $result)
            {
                $students_all[] = $result->user;
                $subs[] = $result->subject;
            }
            $students = array_filter($students_all);
            $users = $form->users()->whereHas('roles',function($role){
                $role->where('name','student');
            })->get()->sortBy('firstName',0);

            // return results to the calling function
            return response()->json([
                'subjects'=>$subjects,
                'results'=>$results,
                'students'=>$users,
                'users'=>$students
            ]);
        }
    }

    // view gradesheet page
    public function gradesheet($id)
    {
        $exam = Exam::find($id);
        $date = date('Y-m-d');
        $term = $exam->term;
        $school = $term->school;
        
        return view('schools.gradesheets.olevel',compact(['exam','school','term']));
    }

    //generate marksheet
    public function generateMarksheet(Request $request)
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
        // return view('schools.gradesheets.olevel',compact(['exam','school','term','form','students','stream','level']))->with('task','Generate marksheet');
    }
    // exam reports view
    public function examReport($id)
    {
        $form = Form::find($id);
        $school = $form->school;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        $students = $form->users()->whereHas('roles',function($role){
            $role->where('name','student');
        })->get()->sortBy('firstName',0);
        $exams = $term->exams()->where('add_to_reports',true)->get();
        return view('schools.examReports.adminReport',compact(['students','form','school','term','exams']));
    }

    // exam reports view
    public function academicReport(Request $request)
    {
        $id = $request->input('form_id');
        $form = Form::find($id);
        $stream_id = $request->input('stream_id');
        $stream = ($stream_id !='') ? Stream::find($stream_id) : '';
        $school = $form->school;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        $students = $form->users()->whereHas('roles',function($role){
            $role->where('name','student');
        })->get()->sortBy('firstName',0);
        $exams = $term->exams()->where('add_to_reports',true)->get();
        return view('schools.examReports.adminReport',compact(['students','form','school','term','exams','stream']));
    }
}
