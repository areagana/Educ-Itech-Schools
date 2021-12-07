<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    
    // access front page information by users
    public function contacts()
    {
        return view('contacts');
    }

    /**
     * services rendered by the company
     */
    public function services()
    {
        return view('services');
    }

    /**
     * our active clients
     */
    public function clients()
    {
        return view('clients');
    }

    /**
     * how to do some things inside the system
     */
    public function howto()
    {
        return view();
    }
}

