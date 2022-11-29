<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Coursework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseworkController extends Controller
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
    public function store(Request $request,$id)
    {
        $topic = Topic::find($id);
        $subject = $topic->subject;
        $school = $subject->school;
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('y-m-d'))
                                ->first();
                                

        foreach($request->user_id as $key=> $user)
        {
            $record = Coursework::updateOrCreate(
                ['student_id'=>$user,'subject_id'=>$subject->id,'topic_id'=>$topic->id,'school_id'=>$school->id],
                ['term_id'=>$term->id,'marks'=>$request->marks[$key],'created_by'=>Auth::user()->id]
            );
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coursework  $coursework
     * @return \Illuminate\Http\Response
     */
    public function show(Coursework $coursework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coursework  $coursework
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursework $coursework)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coursework  $coursework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coursework $coursework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coursework  $coursework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coursework $coursework)
    {
        //
    }
}
