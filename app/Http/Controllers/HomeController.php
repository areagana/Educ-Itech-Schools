<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\School;
use App\Models\Message;
use App\Mail\Welcomemail;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        // check if user has changed the password on not
        if($user->password_status =='password-changed')
        { 
            if($user->hasRole(['superadministrator','administrator']))
            {
                $schools = School::all();
                $users =[];
                $courses =[];
                $subjects =[];
                $messages = Message::where('status','')->get();
                foreach($schools as $school)
                {
                    $users[] = $school->users->count();
                    $courses[] = $school->courses->count();
                    $subjects[] = $school->subjects->count();
                }
                return view('home',compact(['schools','users','courses','subjects','messages']));
            }elseif($user->hasRole(['teacher','student','school-administrator','ict-admin'])){

                $school = $user->school;
                $term = $school->terms()->whereDate('term_start_date','<=',$date)->whereDate('term_end_date','>=',$date)->first();
                if($user->hasRole(['school-administrator','ict-admin']))
                {
                    if(!$term)
                    {
                        $term ='';
                    }
                    return view('schools.home',compact(['school','term']));
                }
                if($term)
                {
                    $notices = $school->announcements()->wheredate('start_date','<=',$date)
                                                        ->whereDate('end_date','>=',$date)
                                                        ->get()
                                                        ->sortByDesc('id',1);
                    $subjects = $user->subjects();
                    $currentsubjects = Auth::user()->subjects->where('term_id',$term->id);
                    $assigned =[];
                    foreach($currentsubjects as $subject)
                    {
                        $assigned[] = $subject->assignments()->whereDate('close_date','>=',$date)->get();
                    } 
                    // check user role and fetch data accordingly
                    if($user->hasRole(['teacher']))
                    {
                        $pendings = [];
                        $graded =[];
                        $ungraded =[];
                        foreach($subjects as $subject)
                        {
                            foreach($subject->assignments as $assignment)
                            {
                                $pendings[] = $assignment->assignment_submissions->where('submitted_grade','null');
                            }
                        }
                    }elseif(Auth::user()->hasRole(['student']))
                    {
                        $pendings =[];
                        $graded = Auth::user()->assignment_submissions()-> where('submitted_grade','>',0)->get();
                        $ungraded = Auth::user()->assignment_submissions()->where('submitted_grade',null)->get();
                        foreach($subjects as $subject)
                        {
                            foreach($subject->assignments as $assignment)
                            {
                                // assignment submissions where user id is not available
                                $check = $assignment->assignment_submissions->where('user_id',Auth::user()->id);
                                if($check->count() == 0)
                                {
                                    $pendings[] = $assignment;
                                }
                            }
                        }
                    }else{

                        $pendings = [];
                        $graded = [];
                        $ungraded = [];
                        $assigned = [];
                        return view('schools.home',compact(['school','term']));
                    }
                    $notice_users =json_decode($notices);
                    return view('dashboard.index',compact(['subjects','term','assigned','pendings','graded','ungraded','notices','notice_users','school']));
                }else{
                    $subjects = [];
                    $pendings = [];
                    $graded = [];
                    $ungraded = [];
                    $assigned = [];
                    
                    $notices = $school->announcements()->wheredate('start_date','<=',$date)
                                                        ->whereDate('end_date','>=',$date)
                                                        ->get()
                                                        ->sortByDesc('id',1);
                                                    
                    $notice_users=json_decode($notices);
                    $subjects = json_decode(json_encode($subjects));
                    $school = Auth::user()->school;

                    return view('dashboard.index',compact(['subjects','term','notices','notice_users','school']));
                }
            }else{
                
            }
        }else{
            return redirect()->route('newPassword.form');
        }
    }

    /**
     * access a form to change password
     */
    public function passwordForm()
    {
        return view('auth.passwords.changePassword');
    }
    /**
     * enable user change password
     */
    public function changePassword(Request $request)
    {
            if(Auth::user()->password_status =='password-changed')
            {
                // do this if user has requested to change the password them selves
                if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                    // The passwords matches
                    return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
                }
            }
        /**
         * do this for the new users logging in for the first time
         */
            if((Hash::check($request->get('password'), Auth::user()->password))){
                //Current password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }
    
            $validatedData = $request->validate([
                'password' => 'required_with:confirm-password|same:confirm-password|string|min:6',
                'confirm-password'=>'min:6'
            ]);
    
            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($request->get('password'));
            $user->password_status = 'password-changed';
            $user->save();
    
            return redirect()->route('home')->with("success","Password changed successfully !");
    }

    
    /**
     * generate barcodes
     */
    public function barcode()
    {
        $users = User::all();
        // generate datatables here
        
        return view('barcode');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTestAddToLog()
    {
        \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('logActivity',compact('logs'));
    }
}
