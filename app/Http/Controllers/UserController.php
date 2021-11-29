<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Form;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * should be accessed by authenticated user
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        $roles = Role::all();
        //only allow logged in users
        if($user->hasRole(['superadministrator','administrator']))
        {
            //get school users
            $school = School::find($id);
            $users = $school->users()->paginate(10);
        }else if($user->hasRole(['ict-admin','school-administrator'])){
            $school = $user->school;
            $users = $school->users()->paginate(10);
        }
        $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
        if(empty($term))
        {
            $term ='';
        }

        return view('users.index',compact(['school','users','term','roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user())
        {
            $user = new User();
            // get user category
            if($request->input('student-class') !=''){
                $class = Form::find($request->input('student-class'));
            }
            $user->firstName = $request->input('first_name');
            $user->lastName = $request->input('last_name');
            $user->email = $request->input('user_email');
            $user->password = Hash::make($request->input('user_password'));
            $user->school_id = $request->input('school_id');
            $user->save();

            /**
             * generate a bar code for the saved user
             */
                $this->generateBarcode($user->id);

                /**
                 * attach role to the created user
                 */
            if($request->input('user-category') == 'Student')
            {
                $user->attachRole('student');
                $user->forms()->attach($class);
            }else if($request->input('user-category') =='Teacher'){
                $user->attachRole('teacher');
            }else if($request->input('user-category') =='Admin'){
                $user->attachRole('administrator');
            }else if($request->input('user-category') =='ict-admin' || $request->input('user-category') =='school-admnistrator'){
                $user->attachRole($request->input('user-category'));
            }else{
                $user->attachRole('user');
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $school = $user->school;
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        $current_subjects = $user->subjects()->where('term_id',$term->id)->get();
        $subjects = $user->subjects;
        $roles = Role::all();
        return view('users.view',compact('user','school','term','subjects','current_subjects','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $school = $user->school;
        $term = $school->terms()->whereDate('term_start_date','<=',date('Y-m-d'))
                                ->whereDate('term_end_date','>=',date('Y-m-d'))
                                ->first();
        if($user->hasRole('student'))
        {
            $class = $user->forms()->latest()->first();
            $current_subjects = $user->subjects()->where('term_id',$term->id)->get();
        }else{
            $class ='';
        }
        $subjects = $user->subjects();
        return view('users.view',compact(['user','school','term','class','subjects','current_subjects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user())
        {
            $user = User::find($id);
            $user->firstName = $request->input('first_name');
            $user->lastName = $request->input('last_name');
            $user->email = $request->input('user_email');

            if(!empty($request->input('user_password')))
            {
                $user->password = Hash::make($request->input('user_password'));
            }
            $user->school_id = $request->input('school_id');
            $user->save();
            return redirect()->back()->with('success','User information updated');
        }
    }

    /**
     * check updating user information
     */
    public function checkUpdate(Request $request)
    {
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user())
        {
            $user = User::find($id);
            if(Auth::user()->isAbleTo('user-delete'))
            {
                $user->delete();
                return redirect()->back()->with('success','User deleted successfully');
            }
            return redirect()->back();
        }
    }

    /**
     * modified user upload method
     */
    public function uploadUsers(Request $request)
    {
        $doc = $request->file('uploaded_file');
        $school_id = $request->input('school_id');
        $status = $request->input('password_status');
        $password = $request->input('password');
        $role = $request->input('user-role');
        
        // check file type
        
        
        if($request->file('uploaded_file'))
        {
            $users = User::pluck('email')->toArray();
            // fetch barcodes to avoid duplication
            $barcodes = User::pluck('barcode')->toArray();
            // get users from the emails by fetching only their emails
            $file = fopen($doc->getRealPath(),'r');
            $usersArray =[];
            $now = now()->toDateTimeString();
            // loop and check through uploaded csv
            $barcodes_created =[];
            $i = 0;
            while($csv = fgetcsv($file))
            {
                if ($i == 0) 
                {
                    $i++; //skip first row with header
                    continue;
                }

                if(!in_array($csv[2],$users))
                {
                    $barcode = $this->barcodeGenerator($barcodes,$barcodes_created);
                    $barcodes[] = $barcode;
                    if($password)
                    {
                        $pass = $password;
                    }else if($csv[3]){ 
                        $pass = $csv[3];
                    }else{
                        throw new \Exception('No password for users input', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
                    }
                    $usersArray[] = [
                            'firstName'=>$csv[0],
                            'lastname'=>$csv[1],
                            'email'=>$csv[2],
                            'password' => Hash::make($pass),
                            'school_id'=>$school_id,
                            'user_role'=>$role,
                            'password_status'=>$status,
                            'account_status'=>'active',
                            'barcode'=> $barcode,
                            'created_at'=>$now,
                            'updated_at'=>$now
                    ];
                }
            }
            // insert users into the users table
            if(User::insert($usersArray))
            { 
                // attach role to users if insertion has been done
                $newUsers = User::where('user_role',$role)
                                ->where('school_id',$school_id)
                                ->where('created_at',$now)
                                ->get();
                $roleFound = Role::where('name',$role)->first();
                // attach roles to new created users//
                foreach($newUsers as $user)
                {
                    $user->attachRole($roleFound);
                }
                return redirect()->back()->with('success','Users uploaded successfully');
            }else{
                return "error inserting users";
            }
            
           return redirect()->back()->with('error','Error uploading users');
        }
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

            }else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

    /**
     * send an email to the user one the account has been created
     */
    public function sendEmail($email, $name)
    {
        $data = array(
        'email' => $email,
        'name' => $name,
        'subject' => 'Welcome Message',
        );
        // send an email to the new users
        Mail::send('welcomeEmail', $data, function ($message) use ($data){
            $message->from('welcome@myapp.com');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }
    
    /**
     * generate barcode and store
     */
    private function barcodeGenerator($array,$array2)
    {
        try{
            $barcode = mt_rand(1000000000, 9999999999);
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if(in_array($barcode,$array) || in_array($barcode,$array2)) 
            {
                $barcode = barcodeGenerator($array); // generate another barcode if duplicate is found;
            }else{
                Log::error($e);
            }
        }
        return $barcode;
    }
    /**
     * generate bar code for users
     */
    private function generateBarcode($user_id) {
        try{
            $user = User::find($user_id);
            $user->barcode = mt_rand(1000000000, 9999999999);
            $user->save();
    
        } catch (Exception $e) {
            $error_info = $e->errorInfo;
            if($error_info[1] == 1062) { // duplicate code found
                generateBarcode($user_id);
            } else {
                // Only logs when an error other than duplicate happens
                Log::error($e);
            }
        }
    }

    /**
     * activate user account
     */
    public function activateAccount(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $email = $request->email;
            $user = User::find($id);
            $data = ['account_status'=>'active'];

            if(Auth::user()->email == $email)
            {
                $user->account_status = 'active';
                $user->save();
                return response()->json(['success','User Account activated successfully']);
            }else{
                return response()->json(['success','You dont have access to activate user account']);
            } 
        }
    }

    /**
     * suspend user account
     */
    public function suspendAccount(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $email = $request->email;
            $user = User::find($id);
            $data = ['account_status'=>'suspended'];

            if(Auth::user()->email == $email)
            {
                $user->account_status = 'suspended';
                $user->save();
                return response()->json(['success','User Account suspended successfully']);
            }else{
                return response()->json(['success','You dont have access to suspend user account']);
            }            
        }
    }

}
