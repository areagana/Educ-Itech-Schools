<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
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
        $note = new Note();
        $note->module_id = $request->input('module_id');
        $note->subject_id = $request->input('subject_id');
        $note->note_title = $request->input('note_title');
        if(!empty($request->input('note_content')))
        {
            $note->note_content = $request->input('note_content');
            $note->note_status = "Posted";
            $note->save();
            return redirect()->route('modules')->with('success');
        }else if($file=$request->file('file'))
        {
            $subject = Subject::find($note->subject_id);
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(storage_path('app/Modules/'.$subject->subject_code),$fileName);
            $note->attachment_name = $fileName;
            $note->note_status = "Posted";
            $note->save();
            return redirect()->route('modules')->with('success');
        }
        return;
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
    public function destroy($id)
    {
        //
    }
}
