<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\School;
use App\Models\Form;
use App\Models\User;
use App\Models\Subject;
use App\Models\Graduate;

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
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        return view('forms.index',compact(['school','forms','term']));
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
        $form->form_level = $request->input('form_level');
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
        $date = date('Y-m-d');
        $school = $form->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        $students = $school->users()->whereRoleIs('student')->sortable()->paginate(10);
        return view('forms.enroll',compact(['form','school','students','term']));
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
        return redirect()->route('schoolForms',$form->school->id)->with('success',count($students).' students enrolled in  '.$form->form_name);
    }

    /**
     * un enroll students from the subject
     */
    public function unEnrollFromSubject(Request $request)
    {
        if($request->ajax())
        {
            $sub = $request->subject;
            $subject = Subject::find($sub);
            $list = $request->list;
            $email = $request->email;
            // get user password
            
            if(Auth::user()->email === $email) // if the passwords match, continue to un enroll
            {
                foreach($list as $id)
                {
                    $user = User::find($id);
                    $user->subjects()->detach($subject);
                }
                return response()->json(['success'=>'Users have been removed from '.$subject->subject_name]);
            }else{
                return response()->json(['success'=> Hash::make($pw)]);
            }
        }
    }


    /**
     * promote students to a new class
     */
    public function promoteStudents(Request $request)
    {
        if($request->ajax())
        {

            $id = $request->newform;
            $list = $request->list;
        // check the class that the members are going to
            if($id == 100) // the id assigned to graduates
            {
                $users =[];
                foreach($list as $student)
                {
                    $users[] = User::find($student);
                }
                
                 Graduate::create($users);
                /**
                 * delete all records from the users table
                 */

            }

            $form = Form::find($id);
            // attach all users to the form
            foreach($list as $student)
            {
                $user = User::find($student);
                $user->forms()->sync($form);
            }
            return response()->json(['Success'=>"promotion successfull"]);
        }
    }

    public function view($id)
    {
        $form = Form::find($id);
        $date = date('Y-m-d');
        $school = $form->school;
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        return view('forms.view',compact(['form','school','term']));
    }                           

}
