<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Subject;
use App\Models\Dashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $form = $card->form;
        $topics = $subject->topics()->where('form_id',$form->id)->get();
        return view('subjects.topics.index',compact(['subject','topics','card']));
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
        $topic = new Topic;
        $topic->name = $request->input('topic_name');
        $topic->subject_id = $request->input('subject_id');
        $subject = Subject::find($topic->subject_id);
        $school = $subject->school;
        $date = date('Y-m-d H:i:s');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $topic->term_id = $term->id;
        $topic->form_id = $request->input('form_id');
        $topic->user_id = Auth::user()->id;

        // save data
        $topic->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }

    /**
     * mark update
     */
    public function markUpdate($id1,$id2)
    {
        $card = Dashcard::find($id1);
        $topic = Topic::find($id2);
        $form = $card->form;
        $subject = $card->subject;
        $school = $subject->school;
        $students = $form->users()->whereRoleIs('student')->get();

        return view('subjects.topics.update',compact(['card','topic','form','subject','school','students']));
    }
}
