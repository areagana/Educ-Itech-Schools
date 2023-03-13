<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\School;
use App\Models\Stream;
use App\Models\Archive;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
     * edit form
     */
    public function edit($id)
    {
        $form = Form::find($id);
        $school = $form->school;
        $streams = $school->streams;
        $date = date('Y-m-d');
        
        $term = $school->terms()->whereDate('term_start_date','<=',$date)
                                ->whereDate('term_end_date','>=',$date)
                                ->first();
        // print_r($form);
        return view('forms.edit',compact(['form','school','streams','term']));
    }

    /**
     * update stream data
     */
    public function update(Request $request, $id)
    {
        $form = Form::find($id);
        $form->form_name = $request->input('form_name');
        $form->form_code = $request->input('form_code');
        $form->level_id = $request->input('form_level');
        $form->save();

        return redirect()->back();
    }

    /**
     * sync form streams
     */
    public function sync(Request $request, $id)
    {
        $form = Form::find($id);
        $streams = $request->get('form_stream');
        $form->streams()->sync($streams);
        return redirect()->back();
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
        $form->level_id = $request->input('form_level');
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
        $students = $school->students()->paginate(10);
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
        $year = $request->input('academic_year');

        foreach($students as $id)
        {
            $student = Student::find($id);
            $student->form_id = $form->id;
            $student->save();

            $student->forms()->attach($form,['year'=>$year,'academicyear_id']);// add a student to the selected class
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
            $year = $request->year;
            $academic_year = $request->academicyear_id;

             // check the class that the members are going to
            if($id == 100) // the id assigned to graduates
            {
                $users =[];
                foreach($list as $student)
                {
                    $users[] = Student::find($student);
                }
                
                 Graduate::create($users);

                 return response()->json(['Success'=>"Students Graduation successfull and archived"]);
            }elseif($id == 120)
            {
                // $archives =[];
                foreach($list as $member)
                {
                    $student = Student::find($member);
                    $student->form_id = $id;
                    $student->save();

                    // insert student into archive
                    $archive = new Archive;
                    $archive->admin_no = $student->admin_no;
                    $archive->student_id = $student->id;
                    $archive->firstname  = $student->firstname;
                    $archive->lastname = $student->lastname;
                    $archive->email = $student->email;
                    $archive->middlename = $student->middlename;
                    $archive->school_id = $student->school_id;
                    $archive->form_id = $student->form_id;
                    $archive->created_by = Auth::user()->id;
                    $archive->academicyear_id = $academic_year;

                    $archive->save();
                }

                return response()->json(['Success'=>"Students Archive successfull"]);
            }else{

                $form = Form::find($id);

                $errors =[];
                foreach($list as $member)
                {
                    $student = Student::find($member);
                    // first check is use exists in this form
                    if(!$student->forms->contains($form))
                    {
                        $student->form_id = $form->id;
                        $student->save();

                        $student->forms()->attach($form,['year'=>$year,'academicyear_id'=>$academic_year]);
                    }else{
                        $errors[] = $student;
                    }
                }

                return response()->json(['Success'=>"promotion successfull",'failed'=>$errors]);
            }
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
    
    /**
     * destroy form
     */
    public function destroy($id)
    {
        $form = Form::find($id);
        if(Auth::user()->can('form-delete') OR Auth::user()->hasRole('superadministrator'))
        {
            $form->delete();
        }
        return redirect()->back();
    }

}
