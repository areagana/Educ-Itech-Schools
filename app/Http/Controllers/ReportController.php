<?php

namespace App\Http\Controllers;
use PDF;
use Dompdf\Dompdf;
use App\Models\Exam;
use App\Models\Form;
use App\Models\Role;
use App\Models\School;
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
        return $this->middleware(['auth','role:superadministrator|administrtor|school-administrator|ict-admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        
        if($term)
        {
            $subjects = $user->subjects()->where('term_id',$term->id)->get();
        }else{
            $subjects = "";
        }
        $form = $user->forms()->latest()->first();

        view()->share('reports.PDFStudent',[$user,$school,$subjects,$form]);
        $pdf = PDF::loadView('reports.PDFStudent',['user'=>$user,'school'=>$school,'subjects'=>$subjects,'form'=>$form]);
  
        // download PDF file with download method
        return $pdf->download($user->firstName.' '.$user->lastName.'.pdf');
        //return view('reports.studentView',compact(['user','school','subjects','form']));
    }

    /**
     * marksheets
     */
    public function marksheetView($id)
    {
        // check school level
        $exam = Exam::find($id);
        $school = $exam->term->school;
        $category = $school->category->category_name;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
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
            $subjects = $term->subjects()->where('form_id',$id)->pluck('subject_name')->toArray();
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
}
