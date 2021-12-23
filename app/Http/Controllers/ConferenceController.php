<?php

namespace App\Http\Controllers;
use Redirect;
use App\Models\School;
use App\Models\Subject;
use App\Models\Conference;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
     * Add video to conference
     */
    public function addVideo(Request $request)
    {
        $id = $request->input('conference_id');
        $subject_id = $request->input('subject_id');
        $subject = Subject::find($subject_id);
        $school = $subject->course->school->school_name;
        $conference = Conference::find($id);

        if($file = $request->file('conference_video'))
        {
            $name = $file->getClientOriginalName();
            //move file to storage
            $file->move(storage_path('app/public'.'/'.$school.'/'.$subject->subject_name.'/'.$name));
            $conference->conference_video_link = $name;
            $conference->save();
            return redirect()->back()->with('success','Video Added successfully');
        }
    }
    /**
     * watch conference video
     */
    public function watchVideos($id)
    {
        $conference  = Conference::find($id);
        $subject = $conference->subject;
        $video_link = $conference->conference_video_link;

        $path = storage_path('app/public/'.$subject->course->school->school_name.'/'.$subject->subject_name.'/'.$video_link);
        /*
        if($path)
        {
            $video = Storage::disk('local')->get($path);
            $response = Response::make($video, 200);
            $response->header('Content-Type', 'video/mp4');
            return $response;
        }else{
            return;
        } */ 
        return $path;
    }
    function watchVideo($id) {
        
        $conference  = Conference::find($id);
        $subject = $conference->subject;
        $video_link = $conference->conference_video_link;

        $path = storage_path('app/public/'.$subject->course->school->school_name.'/'.$subject->subject_name.'/'.$video_link);
        
        $video = Storage::disk('local')->get($path);
        $response = Response::make($video, 200);
        $response->header('Content-Type', 'video/mp4');
        return $response;
    }
    /**
     * open conference
     */
    public function openConference(Request $request)
    {
        $url = $request->input('url_name');
        return dd($url);
        //return Redirect::to($url);
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
