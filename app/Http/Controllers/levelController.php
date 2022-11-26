<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Level;

class levelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $date = date('Y-m-d');
        $levels = $school->levels();
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        return view('levels.index',compact(['levels','school','term']));
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
        $level = new level;
        $school = School::find($id);
        $level->name = $request->input('level_name');
        $level->school_id = $school->id;
        $level->save();


        $levels = $school->levels();
        return redirect()->route('schoolLevels',$school->id);
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
        $level = Level::find($id);
        
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
    public function destroy($id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->back();
    }

    /**
     * get level data
     */
    public function levelData(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->level_id;
            $level = Level::find($id);
            $forms = $level->forms;
            $subjects = $level->subjects;
            $streams = $level->school->streams;

            // return data
            return response()->json(['forms'=>$forms,'subjects'=>$subjects,'streams'=>$streams]);
        }
    }
}
