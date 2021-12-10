<?php

namespace App\Http\Controllers;

use App\Mail\Newaccount;
use App\Mail\Welcomemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    
     /**
     * send feedback message to the sender
     */
    public function sender(Request $request)
    {
        $email = $request->input('email');
        //Mail::to($email)->send(new Welcomemail());
        Mail::to($email)->send(new Newaccount());
        
        return redirect()->back();
    }
}

