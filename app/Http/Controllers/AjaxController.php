<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Form;
use App\Models\Subject;

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
            $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                    ->whereDate('term_end_date','>=',date('Y-m-d'))
                                    ->first();
            $students = $form->users()->whereRoleIs('student')->paginate(20);

            $subjects = Subject::where('term_id',$term->id)
                                ->where('form_id',$form->id)
                                ->get();
            
            // check if the user has clicked graduated students
            if($form_id == 100)
            {
                $students = $school->graduates;
            }
            //$students = $form->students()->paginate(20);
            return response()->json(['students'=>$students,'subjects'=>$subjects, 'paginate'=>(string)$students->links()]);
        }
    }

    /**
     * mass enroll of students into the subject
     */
    public function subjectMassEnroll(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->subject;
            $studets = $request->array;
            $subject =Subject::find($id);
            $subject->users()->attach($students);
        }
    }
}
