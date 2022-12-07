<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use PDF;
use App\Models\Exam;
use App\Models\Form;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    
    public function mksheetView()
    {
        $id = 1;
        $exam_id = 1;
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))->orderBy('firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();

        return view('pdfs.index',compact(['students','level','form','exam','school','term']));
    }

    public function pdf()
    {
        $id = 1;
        $exam_id = 1;
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))->orderBy('firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        view()->share(['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term]);
        $pdf = PDF::loadView('pdfs.index',['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term])->setPaper('a4', 'landscape');
        
        // download PDF file with download method\
        $name = $school->school_name." ".$form->form_name." ".$exam->exam_name." Marksheet";
        return $pdf->download($name.'.pdf');
    }

    public function pdfReport()
    {
        $id = 1;
        $exam_id = 1;
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))->orderBy('firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();

        return view('reports.pdf',compact(['students','level','form','exam','school','term']));
    }

    //download pdf report
    public function pdfReportDownload()
    {
        $id = 1;
        $exam_id = 1;
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))->orderBy('firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        view()->share(['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term]);
        $pdf = PDF::loadView('reports.pdf',['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term]);
        //->setPaper('a4', 'landscape');
        // download PDF file with download method\
        // $name = $school->school_name." ".$form->form_name." ".$exam->exam_name." Marksheet";
        return $pdf->download('Sample_report.pdf');
    }
}
