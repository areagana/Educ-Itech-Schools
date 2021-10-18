<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Form;
use App\Models\User;

class FormController extends Controller
{
    
    public function __construct()
    {
        return $this->middleware('auth');
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

    /**
     * enroll students into a form / class
     * 
     */
    public function enrollStudents($id)
    {
        $form = Form::find($id);
        $school = $form->school;
        $students = $school->users()->whereRoleIs('student')->sortable()->paginate(10);
        return view('forms.enroll',compact(['form','school','students']));
    }

    /**
     * attach classes to the students selected
     */
    public function enrollStore(Request $request)
    {
        $students = $request->input('selected_student');
        $form_id = $request->input('form_id');
        $form = Form::find($form_id);
        foreach($students as $id)
        {
            $student = User::find($id);
            $student->forms()->sync($form);// add a student to the selected class
        }

        // redirect to the forms page with form students
        return redirect()->route('schoolForms',$form->school->id)->with('success',count($students).' students enrolled in '.$form->form_name);
    }
}
