<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Grading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    // redirect to the page
    public function index($id)
    {
        $school = School::find($id);
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))->whereDate('term_end_date','>=',date('Y-m-d'))->first();
        return view('schools.grade scale.index',compact(['school','term']));
    }

    // store grading scale
    public function store(Request $request)
    {
        // check level
        $scale = new Grading;
        $scale->level_id = $request->input('level_id');
        $scale->min_value = $request->input('min_value');
        $scale->max_value = $request->input('max_value');
        $scale->grade_value = $request->input('grade_value');
        $scale->grade = $request->input('grade');

        // for Alevel scales
        $scale->gradable = $request->input('gradable');
        $scale->average = $request->input('average');
        $scale->highest_value = $request->input('highest_value');
        $scale->lowest_value = $request->input('lowest_value');
        $scale->min_gradable = $request->input('min_gradable');
        if($scale->grade == '')
        {
            $scale->grade = $request->input('award');
        }
        $scale->user_id = Auth::user()->id;

        // save a scale
        $scale->save();

        // return re
        return redirect()->back()->with('success','Scale saved');
    }
}
