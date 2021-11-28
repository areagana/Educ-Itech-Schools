<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

        return view('users.index',compact(['school','users','term']));
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
     * upload users from an excel or csv file to the database
     */
    public function usersUpload(Request $request)
    {
        // get the uploaded document/file

        $file = $request->file('uploaded_file');
        if ($file) 
        {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes

            //Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);

            //Where uploaded file will be stored on the server 
            $location = 'uploads'; //Created an "uploads" folder for that

            // Upload file
            $file->move($location, $filename);

            // In case the uploaded file path is to be stored in the database 
            $filepath = public_path($location . "/" . $filename);

            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;

            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
            {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) 
                {
                    $i++;
                    continue;
                }

                for ($c = 0; $c < $num; $c++) 
                {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;

            foreach ($importData_arr as $importData) 
            {
                $name = $importData[1]; //Get user names
                $email = $importData[3]; //Get the user emails
                $j++;

                try {
                    DB::beginTransaction();
                    Player::create([
                    'name' => $importData[1],
                    'club' => $importData[2],
                    'email' => $importData[3],
                    // generate a bar code for each user created
                    'position' => $importData[4],
                    'age' => $importData[5],
                    'salary' => $importData[6]
                    ]);
                    //Send Email
                    $this->sendEmail($email, $name);
                    DB::commit();

                    

                } catch (\Exception $e) {
                //throw $th;
                    DB::rollBack();
                }
            }
            return response()->json([
            'message' => "$j records successfully uploaded"
            ]);
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);

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
