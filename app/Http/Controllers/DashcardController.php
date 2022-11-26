<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Subject;
use App\Models\Dashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashcardController extends Controller
{
    /**
     * should be accessed by authenticated user
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //$id = decrypt($ID);
        $card = Dashcard::find($id);
        $date = date('Y-m-d');
        $subject = $card->subject;
        $form= $card->form;
        $stream = $card->stream;

        $upcoming = $card->subject->assignments()
                                  ->whereDate('end_date','>=',$date)
                                  ->where('form_id',$card->form->id)
                                  ->get();
        $previous = $card->subject->assignments()
                                  ->whereDate('end_date','<',$date)
                                  ->where('form_id',$card->form->id)
                                  ->get();
        return view('subjects.view',compact(['card','subject','upcoming','previous','form','stream']));
    }

    /**
     * display course work results
     */
    public function coursework($id)
    {
        $card = Dashcard::find($id);
        $form = $card->form;
        $subject = $card->subject;
        $students = $subject->users()->whereRoleIs('student')->wherePivot('form_id',$form->id)->orderBy('firstname','asc')->get();
        $topics = $subject->topics()->where('form_id',$form->id)->get();

        // print_r($students);
        return view('courseworks.index',compact('card','form','subject','students','topics'));
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
     * update subject marks
     */
    public function markUpdate($id)
    {
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $school = $subject->school;
        $form = $card->form;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->latest();

        $exams = $school->exams()->whereDate('lock_date','>=',$date)->get();
        $students = $form->users()->whereRoleIs('student')->get();

        return view('marks.update',compact(['card','form','school','subject','term','exams','students']));
                                
    }

    public function enterResults($id1,$id2)
    {
        $card = Dashcard::find($id1);
        $subject = $card->subject;
        $form = $card->form;
        $exam = Exam::find($id2);
        $school = $form->school;
        $students = $form->users()->whereRoleIs('student')->get();

        return view('marks.update',compact(['card','subject','form','exam','students','school']));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashcard  $dashcard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashcard $dashcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashcard  $dashcard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashcard $dashcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashcard  $dashcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashcard $dashcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashcard  $dashcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashcard $dashcard)
    {
        //
    }
    // generate formlist
    public function formList(Request $request)
    {
        if($request->ajax())
        {   
            $id = $request->card;
            $card = Dashcard::find($id);
            $exam_id = $request->exam;
            $exam = Exam::find($exam_id);
            $form = $card->form;
            $subject = $card->subject;

            $students = $form->users()->whereRoleIs('student')->get();

            // return data
            return response()->json(['students'=>$students,'exam'=>$exam]);
        }
    }

    // enroll teacher in subject
    public function teacherEnroll($id)
    {
        $user = User::find($id);
        $cards = $user->dashcards;
        $school = $user->school;
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();

        return view('teachers.enrollments',compact('user','cards','school','term'));
    }

    /**
     * add teacher card
     */
    public function userCard(Request $request,$id)
    {
        $card = Dashcard::updateOrCreate(
            [
                'user_id'=>$request->input('teacher_id'),
                'subject_id'=>$request->input('subject_id'),
                'form_id'=>$request->input('class_id'),
                'stream_id'=>$request->input('stream_id'),
            ],
            [
                'term_id'=>$request->input('term_id'),
                'created_by'=>Auth::user()->id
            ]
        );

        // return 
        return redirect()->back()->with('success','Enrolled sucessfully');
    }
}
