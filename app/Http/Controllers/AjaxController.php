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
            $students = $form->students()->wherePivot('year',date('Y'))->paginate(20);

            $subjects = $school->subjects;
            
            // check if the user has clicked graduated students
            if($form_id == 100)
            {
                $students = $school->graduates;
            }
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
            $form_id = $request->form_id;
            $stream_id = $request->stream_id;
            $term_id = $request->term_id;

            $students = $request->array;
            $subject = Subject::find($id);
            $subject->students()->attach($students,['form_id'=>$form_id,'stream_id'=>$stream_id,'term_id'=>$term_id,'user_id'=>Auth::user()->id]);
            return response()->json(['success'=>'Students enrolled successfully']);
        }
    }

    /**
     * find form subjects
     */
    public function subjectFind(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $form = Form::find($id);
            $date = date('Y-m-d');
            $term = $form->school->terms()->whereDate('term_start_date','<=',$date)
                                          ->whereDate('term_end_date','>=',$date)
                                          ->first();
            $subjects = $term->subjects()->where('form_id',$id)->get();
            return response()->json(['subjects'=>$subjects,'term'=>$term]);
           
        }
    }

    /**
     * term notice method
     */
    public function termNotice(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $date = date('Y-m-d');
            $school = School::find($id);
            $terms = $school->terms()->whereDate('term_start_date','<=',$date)
                                    ->whereDate('term_end_date','>=',$date)
                                    ->first();
            return response()->json(['terms'=>$terms,'school'=>$school]);
        }
    }
}
