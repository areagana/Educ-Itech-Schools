<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Form;

class FormController extends Controller
{
    
    public function __construct()
    {

    }

    public function index($id)
    {
        $school = School::find($id);
        $forms = $school->forms;
        return view('forms.index',compact(['school','forms']));
    }

    /**
     * store a new form
     */
    public function store(Request $request)
    {
        $form = new Form();
        $form->school_id = $request->input('school_id');
        $form->form_name = $request->input('class_name');
        $form->form_code = $request->input('class_code');
        $form->save();
        return redirect()->back()->with('success','New form created successfully');
    }
}
