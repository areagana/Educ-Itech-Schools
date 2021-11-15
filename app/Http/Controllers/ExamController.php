<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\School;
use App\Models\Form;
use App\Models\Subject;

class ExamController extends Controller
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
        $exam = new Exam();
        $class = $request->input('exam_class');
        if($class !='All classes')
        {
            $exam->form_id = $class;
        }
        $exam->term_id = $request->input('term_id');
        $exam->exam_name = $request->input('exam_name');
        $exam->start_date = $request->input('start_date');
        $exam->end_date = $request->input('end_date');
        $exam->lock_date = $request->input('lock_date');
        $exam->total_points = $request->input('total_points');
        $exam->add_to_reports = $request->input('add_to_reports');
        $exam->save();
        return redirect()->back()->with('success','New exam data has been saved');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $exam = Exam::find($id);
            $exam->delete();
        }
    }
}
