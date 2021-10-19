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
        if(Auth::user()->hasRole('superadministrator'))
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
            return view('dashboard.index');
        }
    }
}
