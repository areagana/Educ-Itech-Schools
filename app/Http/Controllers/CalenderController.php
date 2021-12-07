<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function __contruct()
    {
        return $this->middleware('auth');
    }

    /**
     * get to the calender page
     */
    public function index()
    {
        
        return view('calender.index');
    }
}
