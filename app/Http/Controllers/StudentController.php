<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Examresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

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
        $students = $school->students()->orderBy('firstname')->get();
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
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();

        $login = $request->input('enable_login');
        $max_id = Student::max('id');

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
            $user = User::find($user->id);

            // update student data
            $student->firstname = $request->input('firstname');
            $student->school_id = $school->id;
            $student->admin_no = $school->school_code.'/'.date('y').'/'.$max_id;
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->bar_code = $user->barcode;
            $student->nin = $request->input('nin');
            $student->year = date('Y');
            $student->year_joined = date('Y');
            $student->term_joined = $term->id;
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
            $student->forms()->attach($form,['year'=>date('Y')]);
            
        }else{
            $student->firstname = $request->input('firstname');
            $student->admin_no = $school->school_code.'/'.date('y').'/'.$max_id;
            $student->school_id = $school->id;
            $student->middlename = $request->input('middlename');
            $student->lastname = $request->input('lastname');
            $student->form_id = $request->input('form_id');
            $student->stream_id = $request->input('stream_id');
            $student->email = $request->input('email');
            $student->nin = $request->input('nin');
            $student->lin = $request->input('lin');
            $student->year_joined = date('Y');
            $student->term_joined = $term->id;
            $student->year = date('Y');
            $student->contact = $request->input('contact');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->gender = $request->input('gender');
            $student->payment_code = $request->input('payment_code');
            $student->nationality = $request->input('nationality');
            $student->save();

            $form = Form::find($request->input('form_id'));
            $student->forms()->attach($form,['year'=>date('Y')]);
            // generate student barcode
            $this->generateBarcode($student);
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
        $student = Student::find($id);
        $school = $student->school;
        $level = $student->form->level;
        $forms = $student->forms()->orderByDesc('id')->get();
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        $exams_done = Examresult::distinct(['examresults.exam_id'])->where('examresults.student_id',$student->id)
                                            ->leftJoin('exams','examresults.exam_id','exams.id')
                                            ->get();
        return view('students.show',compact(['student','school','term','level','forms','exams_done']));
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
            $user = User::find($user->id);
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
    private function generateBarcode($student) {
        try{
            $student = Student::find($student->id);
            $student->bar_code = mt_rand(1000000000, 9999999999);
            $student->save();
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) { // duplicate code found
                generateBarcode($student->id);
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

    private function barcodeGenerator($array)
    {
        try{
            $barcode = mt_rand(1000000000, 9999999999);
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if(in_array($barcode,$array)) 
            {
                $barcode = barcodeGenerator($array); // generate another barcode if duplicate is found;
            }else{
                Log::error($e);
            }
        }
        return $barcode;
    }

    // upload students 
    /**
     * modified user upload method
     */
    public function uploadStudents(Request $request,$id)
    {
        $doc = $request->file('form_file_uploaded');
        $school = School::find($id);
        
        // check file type
        
        if($request->file('form_file_uploaded') && $request->file('form_file_uploaded') !='')
        {
            
            $file = fopen($doc->getRealPath(),'r');
            $studentsArray =[];
            $now = now()->toDateTimeString();
            
            // loop and check through uploaded csv
            $barcodes_created =[];
            $notInserted =[];
            $i = 0;
            while($csv = fgetcsv($file))
            {
                if ($i == 0) 
                {
                    $i++; //skip first row with header
                    continue;
                }

                $barcode = $this->barcodeGenerator($barcodes_created);
                
                $studentsArray[] =[
                    'school_id'=>$school->id,
                    'admin_no'=>$csv[0],
                    'firstname'=>$csv[1],
                    'middlename'=>$csv[2],
                    'lastname'=>$csv[3],
                    'gender'=>$csv[4],
                    'form_id'=>$csv[6],
                    'email'=>$csv[5],
                    'year'=>date('Y'),
                    'bar_code'=>$barcode
                ];
                //get form id 
                $form_id =  $csv[6];
            }
            
            // use transactions to multiple insert data
            DB::begintransaction();
                Student::insert($studentsArray);
                $startId = DB::select('select last_insert_id() as id');
                $startId = $startId[0]->id;
                $lastId = $startId + count($studentsArray) -1;
            DB::commit();

            $student_ids =[];
            for($i=$startId;$i<=$lastId;$i++)
            {
                $student_ids[] = $i;
            }
            
            // attach students to form
            $form = Form::find($form_id);
            $form->students()->attach($student_ids,['year'=>date('Y')]);

            return redirect()->back()->with('success','Students uploaded successfully');
        }

        return redirect()->back()->with('Success','Please select file to attach');
    }
    /**
     * check if the uploaded file has the right properties
     */
    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb

        if (in_array(strtolower($extension), $valid_extension)) 
        {
            if ($fileSize <= $maxFileSize) 
            {
                return 'Allowed';
            }else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }


    /**
     * download students template for a specific class
     */
    public function exportCsv(Request $request,$id)
    {
       
        $form = Form::find($request->input('form_id'));
        $school = School::find($id);
        $fileName = $school->school_name.'_'.$form->form_name.'_'.$form->id.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('admin_no','firstname', 'middlename', 'lastname', 'gender','email','form_id');

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // vuew all students by superadmin
    public function allStudents()
    {
        if(Auth::user()->hasRole(['superadministrator','administrator']))
        {
            $schools = School::all();
            return view('students.all',compact(['schools']));
        }
    }

    // search student
    public function search(Request $request)
    {
        $text = $request->text;
        $id = $request->school_id;
        $school = School::find($id);
        $students = $school->students()->where('firstname','like','%'.$text.'%')
                                      ->orWhere('lastname','like','%'.$text.'%')
                                      ->get();

        return response()->json(['students'=>$students]);
    }
}
