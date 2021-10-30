<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;
use App\Models\Subject;
use Dompdf\Dompdf;
use PDF;

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
        $subject = Subject::find($note->subject_id);
        if(!empty($request->input('note_content')))
        {
            $note->note_content = $request->input('note_content');
            $note->note_status = "Posted";
            $note->save();
            return redirect()->route('subjectNotes',$subject->id)->with('success');
        }else if($file=$request->file('file'))
        {
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(storage_path('app/Modules/'.$subject->subject_code.'/'),$fileName);
            $note->attachment_name = $fileName;
            $note->note_status = "Posted";
            $note->save();
            return redirect()->route('subjectNotes',$subject->id)->with('success');
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
        $note = Note::find($id);
        $module = $note->module;
        $subject = $module->subject;
        return view('subjects.notes.view',compact(['note','module','subject']));
    }


    /**
     * download content into a pdf
     */
    public function createPDF($id)
    {
        $note = Note::find($id);
        view()->share('subjects.notes.pdfNotes',$note);
        $pdf = PDF::loadView('subjects.notes.pdfNotes',['note'=>$note]);
  
        // download PDF file with download method
        return $pdf->download($note->note_title.'.pdf');
    }

    /**
     * download notes attachmen
     */
    public function downloadNotes($id)
    {
        $note = Note::find($id);
        $module = $note->module;
        $subject = $module->subject;
        $path = storage_path('app/Modules').'/'.$subject->subject_code.'/'.$note->attachment_name;
        return response()->download($path);
    }

    public function OpenNotes($id)
    {
        $note = Note::find($id);
        $module = $note->module;
        $subject = $module->subject;
        $path = storage_path('app/Modules').'/'.$subject->subject_code.'/'.$note->attachment_name;
        $content = file_get_contents($path);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        //return response()->download($path);
        //return $content;
        return $dompdf->stream();
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
            $note = Note::find($id);
            $subject = $note->module->subject;
            $note->delete();
            return response()->json(['link'=>'/subject/'.$subject->id.'/notes']);
        }
    }
}
