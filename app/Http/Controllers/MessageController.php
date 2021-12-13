<?php

namespace App\Http\Controllers;

use Mailgun\Mailgun;
use App\Models\Message;
use App\Mail\Newaccount;
use App\Mail\Welcomemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        
        // send an email using mailgun
        //Mail::to($email)->send(Welcomemail());
        
        // send email to the message sender
        Mail::to($email)->send(new Welcomemail());
        
        return redirect()->back()->with('success','Your message has been sent');
    }

    /**
     * Fetch messages to the admin page
     */
    public function fetchMessages()
    {
        if($this->middleware('auth'))
        {
            if(Auth::user()->hasRole(['administrator','superadministrator']))
            {
               $messages = Message::all()->sortByDesc('id',0);
               return view('messages.index',compact('messages'));
            }
       }
        return redirect()->back();
    }
}

