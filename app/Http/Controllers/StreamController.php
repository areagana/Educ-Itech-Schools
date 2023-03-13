<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\School;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    
    /**
     * allow only logged in users to access the controller
     */
    public function __coonstruct()
    {
        return $this->middleware('auth');
    }

    public function index(Request $request)
    {
    
            $school = School::find($request->id);
            $streams = $school->streams;
            $date = date('Y-m-d');
            $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();

            if(Auth::user()->hasRole(['superadministrator','administrator']))
            {
                $schools = School::all();
                return view('streams.index',compact(['streams','school','term','schools']));
            }
            return view('streams.index',compact(['streams','school','term']));
    }

    // create a new stream
    public function create()
    {
        $stream = New Stream;
        return view('streams.create');
    }

    // stream store
    public function store(Request $request)
    {
        $stream = new Stream;
        $stream->name = $request->input('name');
        $stream->school_id = $request->input('school_id');
        // save stream
        $stream->save();
        // return with message
        return redirect()->back()->with('success','Stream Data Saved');
    }
}
