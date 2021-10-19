<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Form;

class AjaxController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * get form students
     */
    public function formStudents(Request $request)
    {
        if($request->ajax())
        {
            $form_id = $request->class_id;
            $school_id = $request->school_id;
            $school = School::find($school_id);
            $form = Form::find($form_id);
            $students = $form->users()->whereRoleIs('student')->paginate(10);
            
            //$students = $form->students()->paginate(20);
            return response()->json(['students'=>$students,'paginate'=>(string)$students->links()]);
        }
    }
}
