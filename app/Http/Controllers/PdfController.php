<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use PDF;
use App\Models\Exam;
use App\Models\Form;
use App\Models\Stream;
use Illuminate\Http\Request;
use Knp\Snappy\Pdf as snappy;
use Illuminate\Support\Facades\App;

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

    public function pdfReport(Request $request)
    {
        $id = $request->input('form_id');
        $exam_id = $request->input('exam_id');
        $stream_id = $request->input('stream_id');
        $stream = ($stream_id !='') ? Stream::find($stream_id) : '';
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))
                                    ->leftJoin('examresults','students.id','=','examresults.student_id')
                                    ->where('examresults.exam_id',$exam_id)
                                    ->orderBy('students.firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        $logo = is_file(__dir__.'/../../public/'.$school->school_logo) ? $school->school_logo : 'module-icon.jpg';
        $header = 'reports.headers.'.$school->reg_no;
        $footer = 'reports.footers.'.$school->reg_no;

        // $snappy = App::make('snappy.pdf.wrapper');
        // $pdf = $snappy->loadView('reports.pdfDownload',['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term,'stream'=>$stream]);
        //->setPaper('a4', 'landscape');
        // download PDF file with download method\
        // $name = $school->school_name."_".$form->form_name."_".$exam->exam_name."_Reports";
        // return $pdf->download($name.'.pdf');
        $header = 'reports.headers.'.$school->reg_no;
        $footer = 'reports.footers.'.$school->reg_no;

        // $snappy->setOptions([
        //     'page-size'=>'a4',
        //     'minimum-font-size'=>'12'
        // ]);
        // return $snappy->stream();

        // check level and redirect
        $levelnames =[
            0=>'nusery',
            1=>'primary',
            2=>'olevel',
            3=>'advanced'
        ];
        $levelReport = $levelnames[$level->grade_level];
        return view('reports.'.$school->reg_no.".".$levelReport.'_general',compact(['students','level','form','exam','school','term','stream','header','footer','logo']));

        // if($level->grade_level == 3){ // alevel report
        //     return view('reports.'.$levelReport,compact(['students','level','form','exam','school','term','stream','header','footer','logo']));
        // }elseif($level->grade_level ==2){ // olevel report
        //     return view('reports.'.$levelReport,compact(['students','level','form','exam','school','term','stream','header','footer','logo']));
        // }elseif($level->grade_level ==1){ // primary report
        //     return view('reports.'.$levelReport,compact(['students','level','form','exam','school','term','stream','header','footer','logo']));
        // }elseif($level->grade_level ==0){ // kg report // nursery report
        //     return view('reports.'.$levelReport,compact(['students','level','form','exam','school','term','stream','header','footer','logo']));
        // }
        // return view('reports.pdf',compact(['students','level','form','exam','school','term','stream','header','footer','logo']));
    }

    //download pdf report
    public function pdfReportDownload(Request $request)
    {
        $id = $request->formid;
        $exam_id = $request->examid;
        $stream_id = $request->streamid;
        $stream = ($stream_id !='') ? Stream::find($stream_id) : '';
        $exam = Exam::find($exam_id);
        $form = Form::find($id);
        $school = $form->school;
        $level = $form->level;
        $students = $form->students()->wherePivot('year',date('Y'))
                                    ->rightJoin('examresults','students.id','=','examresults.student_id')
                                    ->where('examresults.exam_id',$exam_id)
                                    ->orderBy('students.firstname')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        $logo = is_file(__dir__.'/../../public/'.$school->school_logo) ? $school->school_logo : 'module-icon.jpg';
        $header = 'reports.headers.'.$school->reg_no;
        $footer = 'reports.footers.'.$school->reg_no;

        // view()->share(['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term,'stream'=>$stream]);
        $snappy = App::make('snappy.pdf.wrapper');
        $levelnames =[
            0=>'nusery',
            1=>'primary',
            2=>'olevel',
            3=>'advanced'
        ];
        $levelReport = $levelnames[$level->grade_level];
        $pdf = $snappy->loadView('reports.'.$school->reg_no.".".$levelReport,['students'=>$students,'level'=>$level,'form'=>$form,'school'=>$school,'exam'=>$exam,'term'=>$term,'stream'=>$stream,'logo'=>$logo,'header'=>$header,'footer'=>$footer]);
        //->setPaper('a4', 'landscape');
        // download PDF file with download method\
        $name = $school->school_name."_".$form->form_name."_".$exam->exam_name."_Reports";
        // return $pdf->download($name.'.pdf');
        
        $snappy->setOptions([
            'page-size'=>'A4',
            'minimum-font-size'=>'12',
            'footer-font-size'=>'10',
            'margin-top'=>'1',
            'footer-line'=>true,
            'footer-font-name'=>'Times New Roman',
            'footer-left'=>['Next term begins on: '.date('d/m/y')],
            'footer-right'=>['Date of issue: '.date('d/m/y')],
            'footer-center'=>'Invalid without '.strToLower($school->school_name).' stamp'
        ]);
        return $snappy->stream();
        // return view('reports.pdfDownload',compact(['students','level','form','exam','school','term','stream']));
        // return $snappy->download($name.'.pdf');
    }
}