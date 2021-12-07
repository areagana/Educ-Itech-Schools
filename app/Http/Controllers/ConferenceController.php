<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Subject;
use App\Models\School;

class ConferenceController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
       $conference = new Conference();
       $subject_id = $request->input('subject_id');
       $conference->subject_id = $subject_id;
       $conference->conference_name = $request->input('conference_title');
       $conference->conference_duration = $request->input('conference_duration');
       $conference->description = $request->input('conference_details');
       $conference->conference_link = $request->input('conference_link');
       $conference->conference_start_date = date('Y-m-d H:m:s');
       $conference->status = 'Set';
       $conference->user_id = Auth::user()->id;
       $conference->save();
       return redirect()->route('subjectConferences',$subject_id);
    }

    public function test()
    {
        dd(\Bigbluebutton::isConnect()); //default 
    
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
     * open conference
     */
    public function openConference($url)
    {
        return Redirect::away('https://'.$url);
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

    public function startConference(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $conference = Conference::find($id);
            $conference->status = 'Active';
            $conference->save();
        }
    }

    /**
     * endconference
     */
    public function endConference(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $conference = Conference::find($id);
            $conference->status = 'Ended';
            $conference->save();
        }
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
            $conference = Conference::find($id);
            if(Auth::user()->owns($conference))
            {
                $conference->delete();
                return response()->json(['success','Conference deleted successfully']);
            }else{
                return;
            }
        }
    }
}
