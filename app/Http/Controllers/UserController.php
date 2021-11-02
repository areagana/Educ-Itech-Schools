<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Form;

class UserController extends Controller
{
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
            if($request->input('user-category') =='Student')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

}
