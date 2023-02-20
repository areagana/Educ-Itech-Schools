<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Form;
use App\Models\Term;
use App\Models\School;
use App\Models\Subject;
use App\Models\Dashcard;
use App\Models\Examresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamResultsController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
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
        $school_id = $request->input('school_id');
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');
        $term_id = $request->input('term_id');
        $subject = Subject::find($subject_id);
        $form = $request->input('form_id');

        /**
         * get data
         */
        $users = $request->input('student_id');
        $marks = $request->input('marks');
        $comments = $request->input('comment');
        $data =[
            $users,$marks,$comments
        ];

        for($i=0;$i<count($users);$i++)
        {
            $result = new Examresult();
            $result->user_id = $users[$i];
            $result->subject_id = $subject_id;
            $result->form_id = $request->input('form_id');
            $result->exam_id = $exam_id;
            $result->term_id = $term_id;
            $result->school_id = $school_id;
            $result->marks = $marks[$i];
            $result->comment = $comments[$i];
            $result->teacher_id = Auth::user()->id;
            $result->effort = $this->getEffort($result->marks);
            $result->save();
        }

        // enable update or insert here
        return redirect()->back()->with('success','Exam results saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        $school_id = $request->input('school_id');
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');
        $term_id = $request->input('term_id');
        $subject = Subject::find($subject_id);
        $card = Dashcard::find($request->input('card_id'));
        $school = School::find($school_id);
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        
        /**
         * get data
         */
        $students = $request->input('student_id');
        $marks = $request->input('marks');
        $comments = $request->input('comment');
        $data =[
            $students,$marks,$comments
        ];

        $results =[];
        foreach($students as $key => $user)
        {
            // print_r($user); echo "<br>";
            $saved = Examresult::updateOrCreate(
                [
                    'exam_id'=>$exam_id,
                    'student_id'=>$user,
                    'school_id'=>$school_id,
                    'form_id'=>$request->input('form_id'),
                    'term_id'=>$term->id,
                    'subject_id'=>$subject_id,
                    'paper_id'=>$request->input('paper_id')
                ],
                [
                    'user_id'=>Auth::user()->id,
                    'marks'=>$marks[$key],
                    'effort'=>$this->getEffort($marks[$key]),
                    'comment'=>$this->comment($comments[$key])
                ]
            );
        }
        return redirect()->route('subjectAssessments',$card->id)->with('success','Exam results updated successfully');
    }

    public function updateAdmin(Request $request)
    {
        $school_id = $request->input('school_id');
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');
        $term_id = $request->input('term_id');
        $term = Term::find($term_id);
        $subject = Subject::find($subject_id);
        $school = School::find($school_id);
        
        
        /**
         * get data
         */
        $students = $request->input('student_id');
        $marks = $request->input('marks');
        $data =[
            $students,$marks
        ];

        $results =[];
        foreach($students as $key => $user)
        {
            // print_r($user); echo "<br>";
            $saved = Examresult::updateOrCreate(
                [
                    'exam_id'=>$exam_id,
                    'student_id'=>$user,
                    'school_id'=>$school_id,
                    'form_id'=>$request->input('form_id'),
                    'term_id'=>$term->id,
                    'subject_id'=>$subject_id,
                    'paper_id'=>$request->input('paper_id')
                ],
                [
                    'user_id'=>Auth::user()->id,
                    'marks'=>$marks[$key],
                    'effort'=>$this->getEffort($marks[$key])
                ]
            );
        }
        return redirect()->back()->with('success','Exam results updated successfully');
    }
    /**
     * admin update function
     */

     public function adminUpdate(Request $request,$examid,$formid,$subjectid)
     {
        $exam = Exam::find($examid);
        $form = Form::find($formid);
        $subject = Subject::find($subjectid);
        $school = $subject->school;
        $term = $exam->term;

        // print_r($subject->id);
        
        return view('exams.adminUpdate',compact(['exam','subject','form','school','term']));
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
     * function to create effort
     */
    protected function getEffort($mark)
    {
        if($mark<=25 AND $mark >=1)
        {
            $effort = 1;
        }else if($mark <=45){
            $effort = 2;
        }else if($mark <=70){
            $effort = 3;
        }else if($mark <=85){
            $effort = 4;
        }else{
            $effort = 5;
        }
        return $effort;
    }

    protected function comment($comm)
    {
        if(!$comm)
        {
            $comment = "no comment";
        }else{
            $comment = $comm;
        }
        return $comment;
    }
}
