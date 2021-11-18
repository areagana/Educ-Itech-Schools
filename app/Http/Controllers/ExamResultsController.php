<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Examresult;
use App\Models\Exam;
use App\Models\School;
use App\Models\Form;
use App\Models\Term;

class ExamResultsController extends Controller
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
        $form = $subject->form;

        /**
         * get data
         */
        $users = $request->input('user_id');
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
            $result->form_id = $form->id;
            $result->exam_id = $exam_id;
            $result->term_id = $term_id;
            $result->school_id = $school_id;
            $result->marks = $marks[$i];
            $result->comment = $comments[$i];
            $result->teacher_id = Auth::user()->id;
            $result->effort = $this->getEffort($result->marks);
            $result->save();
        }
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
        $form = $subject->form;

        /**
         * get data
         */
        $users = $request->input('user_id');
        $marks = $request->input('marks');
        $comments = $request->input('comment');
        $data =[
            $users,$marks,$comments
        ];

        for($i=0;$i<count($users);$i++)
        {
            $data =[
                'marks'=>$marks[$i],
                'comment'=>$comments[$i],
                'effort'=>$this->getEffort($marks[$i]),
                'teacher_id'=>Auth::user()->id
            ];
            Examresult::where('subject_id',$subject_id)
                        ->where('exam_id',$exam_id)
                        ->where('user_id',$users[$i])
                        ->where('term_id',$term_id)
                        ->update($data);
        }
        return redirect()->back()->with('success','Exam results updated successfully');
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
}
