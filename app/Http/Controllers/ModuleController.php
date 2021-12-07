<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Note;

class ModuleController extends Controller
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
    public function index($id)
    {
        $subject = Subject::find($id);
        $modules = $subject->modules;
        return view('subjects.notes.index',compact(['subject','modules']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $module = new Module();
        $subject = subject::find($id);
        $modules = $subject->modules;
        $newmodule ='Create';
        return view('subjects.notes.index',compact(['subject','modules','newmodule']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = new Module();
        $subject = Subject::find($request->input('subject_id'));
        $module->module_name = $request->input('module_name');
        $module->subject_id = $request->input('subject_id');
        $module->module_status = 'Created';
        $module->save();
        
        return redirect()->route('subjectNotes',$subject->id)->with('success','Module Created successfully');
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
     * update backgground-color
     */
    public function background(Request $request)
    {
        if($request->ajax())
        {
            $color = $request->color;
            $id = $request->module;
            $module = Module::find($id);
            $subject = $module->subject;
            $module->background_color = $color;
            $module->save();
            return response()->json(['link'=>'/subject/'.$subject->id.'/notes']);
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
            $module = Module::find($id);
            $subject = $module->subject;
            $module->delete();
            $currentURL = url()->current();
            return response()->json(['link'=>"/subject/".$subject->id."/notes"]);
        }
        return;
    }
}
