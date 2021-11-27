<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

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
        if($user->hasRole(['superadministrator','administrator']))
        {
            $schools = School::all();
            $users =[];
            $courses =[];
            $subjects =[];
            foreach($schools as $school)
            {
                $users[] = $school->users->count();
                $courses[] = $school->courses->count();
                $subjects[] = $school->subjects->count();
            }
            return view('home',compact(['schools','users','courses','subjects']));
        }
        /**
         * redirect other users to the dashboard
         */
        else{
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
                $subjects = $user->subjects()->where('term_id',$term->id)->get();
                $currentsubjects = Auth::user()->subjects->where('term_id',$term->id);
                $assigned =[];
                foreach($currentsubjects as $subject)
                {
                    $assigned[] = $subject->assignments()->whereDate('close_date','>=',$date)->get();
                } 
                 // check user role and fetch data accordingly
                 if(Auth::user()->hasRole(['teacher']))
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
                 }
            }else{
                $subjects ='';
            }
            return view('dashboard.index',compact(['subjects','term','assigned','pendings','graded','ungraded']));
        }
    }

    /**
     * generate barcodes
     */
    public function barcode()
    {
        return view('barcode');
    }
}
