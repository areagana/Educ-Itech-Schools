<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
        // store the message into the messages table
        $email = $request->input('email');

        $mess = new Message();

        $mess->name = $request->input('name');
        $mess->subject = $request->input('subject');
        $mess->email = $email;
        $mess->message = $request->input('message');
        $mess->ip_address = $request->ip();
        $mess->save();
        

        //Mail::to($email)->send(new Welcomemail());
        Mail::to($email)->send(new Welcomemail());
        // send email to admin
        //Mail::to('info@educitech.com')->send();
        
        return redirect()->back()->with('success','Your message has been sent');
    }
}

