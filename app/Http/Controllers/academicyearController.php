<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Academicyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class academicyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $academicyears = $school->academicyears()->get()->sortBy('id desc');
        $term = $school->terms()->whereDate('term_start_date','<=',"Y-m-d")
                                ->whereDate('term_end_date','>=',"Y-m-d")
                                ->latest();

        return view('schools.academicyear.index',compact(['school','academicyears','term']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $school = School::find($id);
        $academicyears = $school->academicyears()->get()->sortby('id');
        $term = $school->terms()->whereDate('term_start_date','<=',"Y-m-d")
                                ->whereDate('term_end_date','>=',"Y-m-d")
                                ->latest();

        return view('schools.academicyear.create',compact(['school','academicyears','term']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acyear = new Academicyear();
        $acyear->school_id = $request->input('school_id');
        $acyear->name = $request->input('name');
        $acyear->start_date = $request->input('start_date');
        $acyear->end_date = $request->input('end_date');
        $acyear->user_id = Auth::user()->id;
        $acyear->save();

        return redirect()->route('academicyears',$acyear->school_id)->with(['success'=>'New academic year created successfully']);
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
        $acyear = Academicyear::find($id);
        $school = $acyear->school;
        $term = $school->terms()->whereDate('term_start_date','<=',"Y-m-d")
                                ->whereDate('term_end_date','>=',"Y-m-d")
                                ->latest();
        return view('schools.academicyear.edit',compact(['acyear','school','term']));
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
        $acyear = Academicyear::find($id);
        $acyear->name = $request->input('name');
        $acyear->start_date = $request->input('start_date');
        $acyear->end_date = $request->input('end_date');
        $acyear->user_id = Auth::user()->id;
        $acyear->save();

        return redirect()->route('academicyears',$acyear->school_id)->with(['success'=>'Academic year updated successfully']);
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

    // get academic year terms
    public function acyearTerms(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $acyear = Academicyear::find($id);
            $terms = $acyear->terms();
            // print_r($acyear);
            return response()->json(['terms'=>$terms]);
        }
    }
}
