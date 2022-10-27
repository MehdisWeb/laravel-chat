<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
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
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userid =null)
    {
        
        $reciever = 4;
        if (!is_null($userid)){
           
        $reciever = $userid;
        }

        if (!is_null($userid) && auth()->user()->role  !='admin'){
            session()->flash('error', "Sorry you don't have access to this page, only Admin does");
            return redirect('/');
        }
        
            return view('chat',compact('reciever'));
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $reciever = $request->input('reciever');
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'reciever' =>$request->input('reciever')
            
        ]);

        broadcast(new MessageSent($user, $message,$reciever))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
