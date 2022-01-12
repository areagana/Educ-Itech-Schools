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

        /*$mgClient = new Mailgun('c44d868b6b71d5f02f47b016fedd0ddb-7005f37e-4edeb639');
        $domain = "educitech.com";

        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
            'from'	=> 'info@educitech.com',
            'to'	=> $email,
            'subject' => $request->input('subject'),
            'text'	=> 'Checking how emails are sent at mailgun'
        ));*/
        $user = [
            'email'=>$email,
            'name'=>$request->input('name'),
            'subject'=>$request->input('subject'),
            'message'=>$request->input('message')
        ];

        // send an email to the message sender informing about their message being delivered
        Mail::send('emails.welcome', function($message) {
            $message->to($email);
            $message->subject($request->input('subject'));
        });

        $mess = new Message();

        $mess->name = $request->input('name');
        $mess->subject = $request->input('subject');
        $mess->email = $email;
        $mess->message = $request->input('message');
        $mess->ip_address = $request->ip();
        $mess->save();
           

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

    /**
     * read messages
     */
    public function read(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $message = Message::find($id);

            $message->status = 'read';
            $message->read_at = date('Y-m-d H:i:s');
            $message->save();

            return response()->json(['message'=>$message]);
        }
    }
}

