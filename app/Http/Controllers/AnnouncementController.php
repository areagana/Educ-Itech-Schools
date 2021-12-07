<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Role;
use App\Models\School;
use File;

class AnnouncementController extends Controller
{
    
    //grant access to the authenticated users only
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        
        if($user->hasRole(['superadministrator','Administrator']))
        {
            $school = School::find($id);
            
        }else{
            $school = $user->school;
        }
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                    ->whereDate('term_end_date','>=',$date)
                                    ->first();
        $notices = $school->announcements->sortByDesc('id',1);
        $roles = Role::all();
        return view('schools.Announcements.index',compact(['school','term','roles','notices']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userview()
    {
        $date = date('Y-m-d');
            $user = Auth::user();
            $school = $user->school;
            $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                    ->whereDate('term_end_date','>=',$date)
                                    ->first();
            $notices = $school->announcements->sortByDesc('id',1);
            $roles = Role::all();
            
            return view('schools.Announcements.userView',compact(['school','term','roles','notices']));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notice = new Announcement();

        if($file = $request->file('announcement_attachment'))
        {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('Announcements'),$fileName);
            $notice->announcement_attachment = $fileName;
        }
        $notice->school_id = $request->input('school_id');
        $notice->announcement_title = $request->input('announcement_title');
        $notice->announcement_content = $request->input('announcement_message');
        $notice->announcement_content = $request->input('announcement_message');
        $notice->start_date = $request->input('start_date');
        $notice->end_date = $request->input('end_date');
        $notice->user_id = Auth::user()->id;
        $notice->users = json_encode($request->input('school_level'));
        $notice->save();
        return redirect()->back()->with('success','Announcement Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $notice = Announcement::find($id);
        if(public_path('Announcements').'/'.$notice->announcement_attachment)
        {
            $path = public_path('Announcements').'/'.$notice->announcement_attachment;
            return response()->download($path);
        } 
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
            $notice = Announcement::find($id);
            if($notice->announcement_attachment)
            {
                $attachment = $notice->announcement_attachment;
                if(File::exists(public_path('Announcements').'/'.$attachment))
                {
                    File::delete(public_path('Announcements').'/'.$attachment);
                } 
            }
            $notice->delete();
        }
    }
}
