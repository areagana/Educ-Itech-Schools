<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Term;
use App\Models\School;

class TermController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','role:superadministrator|administrator']);
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
        $school = School::find($school_id);

        $term = new Term();
        $term->school_id = $school_id;
        $term->term_name = $request->input('term_name');
        $term->term_year = $request->input('term_year');
        $term->term_start_date = $request->input('term_start_date');
        $term->term_end_date = $request->input('term_end_date');
        $term->user_id = Auth::user()->id;
        $term->academicyear_id = $request->input('academicyear_id');
        $term->save();
        
        return redirect()->back()->with('success','New term has been created');
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
        $school = School::find($school_id);
        $term = Term::find($request->input('term_id'));
        $term->school_id = $school_id;
        $term->term_name = $request->input('term_name');
        $term->term_year = $request->input('term_year');
        $term->term_start_date = $request->input('term_start_date');
        $term->term_end_date = $request->input('term_end_date');
        $term->user_id = Auth::user()->id;
        $term->academicyear_id = $request->input('academicyear_id');
        $term->save();
        
        return redirect()->back()->with('success','Term data is updated successfully');
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
            $term = Term::find($id);
            $term->delete();
        }
    }

    /**
     * access school term
     */
    public function schoolTerm($id)
    {
        $school = School::find($id);
        $schoolterms = $school->terms()->orderBy('id','desc')->get();
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $acyear = $school->academicyears()->where('start_date','<=',date('Y-m-d'))
                                          ->where('end_date','>=',date('Y-m-d'))
                                          ->first();
        return view('schools.terms.index',compact(['school','schoolterms','term','acyear']));
    }
}
