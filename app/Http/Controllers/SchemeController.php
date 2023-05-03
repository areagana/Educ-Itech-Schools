<?php

namespace App\Http\Controllers;

use File;
use App\Models\Form;
use App\Models\Term;
use App\Models\Scheme;
use App\Models\School;
use App\Models\Subject;
use App\Models\Dashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $school = School::find($id);
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $allSchemes = $school->schemes()->where('term_id','!=',$term->id)->get();
        $currentschemes = $school->schemes()->where('term_id',$term->id)->get();
        if(Auth::user()->hasRole(['teacher','student']))
        {
            return view('schools.schemes.user',compact(['school','term','allSchemes','currentschemes']));
        }elseif(Auth::user()->hasRole(['administrator','superadministrator','school-administrator']))
        {
            return view('schools.schemes.index',compact(['school','term','allSchemes','currentschemes']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subjectSchemes($id)
    {
        // $subject = Subject::find($id);
        $card = Dashcard::find($id);
        $subject = $card->subject;
        $school = $subject->school;
        $date = date('Y-m-d');
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $allschemes = $subject->schemes ;
        $currentschemes = $subject->schemes;
        return view('schools.schemes.user',compact(['school','term','card','subject','allschemes','currentschemes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($file = $request->file('scheme'))
        {
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(storage_path('app/Schemes'),$fileName);

            $scheme = new Scheme();
            $scheme->school_id = $request->input('school_id');
            $scheme->form_id = $request->input('school_forms');
            $scheme->term_id = $request->input('term_id');
            $scheme->subject_id = $request->input('form_subjects');
            $scheme->scheme_title = $request->input('scheme_title');
            $scheme->attachment_name = $fileName;
            $scheme->user_id = Auth::user()->id;
            $scheme->save();
            return redirect()->back()->with('success','Your scheme has been subitted successfully');
        }
    }

   
    /**
     * download timetable
     */
    /**
     * download assignment document
     */
    public function downloadScheme($id)
    {
        $scheme = Scheme::find($id);

        if(storage_path('app/Schemes').'/'.$scheme->attachment_name)
        {
            $path = storage_path('app/Schemes').'/'.$scheme->attachment_name;
            return response()->download($path);
        }       
    }

    /**
     * view file in page
     */
    public function viewFile($id)
    {
        $date = date('Y-m-d');
        $scheme = Scheme::find($id);
        $school = $scheme->school;

        if(storage_path('app/Schemes').'/'.$scheme->attachment_name)
        {
            $path = storage_path('app/Schemes').'/'.$scheme->attachment_name;
            return response()->file($path);
        }       
    }

    /**
     * publi function destroy timetable
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $scheme= Scheme::find($id);
            $school = $scheme->school;

            if(File::exists(storage_path('app/Schemes').'/'.$scheme->attachment_name))
            {
                File::delete(storage_path('app/Schemes').'/'.$scheme->attachment_name);
            }       
            $scheme->delete();
        }
    }
}
