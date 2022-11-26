<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get school
        if(Auth::user()->hasRole(['superadministrator','administrator']))
        {
            $school = School::find($request->id);
        }else{
            $school = Auth::user()->school;
        }
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        $students = $school->students()->paginate(20);
        return view('students.index',compact('school','students','term'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $school = School::find($id);
        $forms = $school->forms;
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        $student = new Student;
        return view('students.create',compact('school','forms','term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $student = new student;
        $school = School::find($id);

        $login = $request->input('enable_login');

        if(isset($login) && $login == 'on')
        {
            $user = User::create([
                'firstName'=>$request->input('firstname'),
                'middlename'=>$request->input('middlename'),
                'lastName'=>$request->input('lastname'),
                'email'=>$request->input('email'),
                'password'=>Hash::make('12345678'),
                'school_id'=>$school->id,
                'status'=>1,
                'user_role'=>'student'
            ]);
            $user->roles()->attach([7]);
            $this->generateBarcodeUser($user->id);
            
            // update student data
            $student->firstname = $request->input('firstname');
            $student->school_id = $school->id;
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->bar_code = $user->barcode;
            $student->nin = $request->input('nin');
            $student->year = date('Y');
            $student->lin = $request->input('lin');
            $student->contact = $request->input('contact');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->gender = $request->input('gender');
            $student->user_id = $user->id;
            $student->payment_code = $request->input('payment_code');
            $student->nationality = $request->input('nationality');
            $student->save();
            // attachh class
            $form = Form::find($request->input('form_id'));
            $student->forms()->attach($form)->with('year',2022);
            
        }else{
            $student->firstname = $request->input('firstname');
            $student->school_id = $school->id;
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->nin = $request->input('nin');
            $student->lin = $request->input('lin');
            $student->year = date('Y');
            $student->contact = $request->input('contact');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->gender = $request->input('gender');
            $student->payment_code = $request->input('payment_code');
            $student->nationality = $request->input('nationality');
            $student->save();

            $form = Form::find($request->input('form_id'));
            $student->forms()->attach($form)->with('year',2022);
            // generate student barcode
            $this->generateBarcode($student->id);
        }
        
        // check user role
        if(Auth::user()->hasRole(['superadministrator','administrator']))
        {
            return redirect()->route('schoolStudents',$student->school->id)->with('success','Data updated successfully');
        }else{
            return redirect()->route('students')->with('success','Student created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $school = $student->school;
        $level = $student->form->level;
        $forms = $student->forms()->orderByDesc('id')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        return view('students.edit',compact(['student','school','term','level','forms']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $login = $request->input('enable_login');

        if(isset($login) && $login == 'on' && $student->user_id == '')
        {
            $user = User::create([
                'firstName'=>$request->input('firstname'),
                'middlename'=>$request->input('middlename'),
                'lastName'=>$request->input('lastname'),
                'email'=>$request->input('email'),
                'password'=>Hash::make('12345678'),
                'school_id'=>$school->id,
                'status'=>1,
                'user_role'=>'student'
            ]);
            $user->roles()->attach([7]);
            $this->generateBarcodeUser($user->id);
            
            // update student data
            $student->firstname = $request->input('firstname');
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->bar_code = $user->barcode;
            $student->nin = $request->input('nin');
            $student->year = date('Y');
            $student->lin = $request->input('lin');
            $student->contact = $request->input('contact');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->gender = $request->input('gender');
            $student->user_id = $user->id;
            $student->payment_code = $request->input('payment_code');
            $student->nationality = $request->input('nationality');
            $student->save();
            // attachh class
            // $form = Form::find($request->input('form_id'));
           
        }else{
            $student->firstname = $request->input('firstname');
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->nin = $request->input('nin');
            $student->lin = $request->input('lin');
            $student->year = date('Y');
            $student->contact = $request->input('contact');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->gender = $request->input('gender');
            $student->payment_code = $request->input('payment_code');
            $student->nationality = $request->input('nationality');
            $student->save();
            
            // $form = Form::find($request->input('form_id'));
            // $student->forms()->attach($form,array('year'=>date('Y')));
            // generate student barcode
            // $this->generateBarcode($student->id);
        }

        // check user role
        if(Auth::user()->hasRole(['superadministrator','administrator']))
        {
            return redirect()->route('schoolStudents',$student->school->id)->with('success','Data updated successfully');
        }else{
            return redirect()->route('students')->with('success','Data updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->back()->with('success','Student deleted successfully');
    }

    /**
     * generate bar code for users
     */
    private function generateBarcode($id) {
        try{
            $student = Student::find($id);
            $student->bar_code = mt_rand(1000000000, 9999999999);
            $student->save();
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) { // duplicate code found
                generateBarcode($id);
            } else {
                // Only logs when an error other than duplicate happens
                Log::error($e);
            }
        }
    }

    private function generateBarcodeUser($id) {
        try{
            $user= User::find($id);
            $user->barcode = mt_rand(1000000000, 9999999999);
            $user->save();
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) { // duplicate code found
                generateBarcodeUser($id);
            } else {
                // Only logs when an error other than duplicate happens
                Log::error($e);
            }
        }
    }

}
