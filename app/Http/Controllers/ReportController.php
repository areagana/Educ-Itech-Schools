<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\School;
use PDF;
use Dompdf\Dompdf;

class ReportController extends Controller
{
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
        $school = $user->school;
        $subjects = $user->subjects;
        $form = $user->forms->last();
        return view('reports.studentView',compact(['user','school','subjects','form']));
    }

    public function studentReportPDF()
    {
        $user = Auth::user();
        $school = $user->school;
        $subjects = $user->subjects;
        $form = $user->forms->last();

        view()->share('reports.PDFStudent',[$user,$school,$subjects,$form]);
        $pdf = PDF::loadView('reports.PDFStudent',['user'=>$user,'school'=>$school,'subjects'=>$subjects,'form'=>$form]);
  
        // download PDF file with download method
        return $pdf->download($user->firstName.' '.$user->lastName.'.pdf');
        //return view('reports.studentView',compact(['user','school','subjects','form']));
    }
}
