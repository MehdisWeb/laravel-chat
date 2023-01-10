<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Track;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    public $user;

    public function __construct()
    {
       // $this->middleware('api');

    }
    
    public function login(Request $request){
        error_log("HOLA");
        error_log($request->email);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                //generate token for the user and save it in the database
                $token = md5(time()) . md5($request->email);
                //user force fill to save the token in the database
                $user->forceFill([
                    'remember_token' => $token,
                ])->save();
                return response()->json(['token' => $token, 'user'=>$user], 200);
            }else{
                return response()->json(['error' => 'UnAuthorised'], 401);
            }
        }else{
            return response()->json(['error' => 'UnAuthorised2'], 401);
        }
    }
    
  //create user Token
    public function createToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = md5(time()) . md5($request->email);
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'UnAuthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'UnAuthorised2'], 401);
        }
    }


    public function updateLocation(Request $request){
        error_log("HOLA");
        error_log($request->email);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'long' => 'required',
            'lat' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user_id = User::where('email', $request->email)->first()->id;
        //check if user has tracks
        $track = Track::where('user_id', $user_id)->first();
        if($track){
            //update track
            //update tracks long & lat by user_id
            $track->long = $request->long;
            $track->lat = $request->lat;
            $track->save();
            error_log("track updated");
            return response()->json(['message' => 'Track updated'], 200);
        }else{
            //create track
            $track = new Track();
            $track->user_id = $user_id;
            $track->long = $request->long;
            $track->lat = $request->lat;
            $track->save();
            return response()->json(['message' => 'Track created'], 200);
        }


    }


    public function getMessages(Request $request){
        error_log("HOLA");

        error_log($request->email);

        $m=[];
        $teacher = User::where('email', $request->email)->first();

        $teacher_messages = $teacher->messages;

        $admin_messages = User::where('id', 4)->first()->messages;
        //filter admin messages where reciver_id = teacher_id
        $admin_messages = $admin_messages->filter(function ($value, $key) use ($teacher) {
            return $value->reciever == $teacher->id;
        });



        $messages = $teacher_messages->merge($admin_messages);
        //sort messages by date and time and reverse it

        $messages = $messages->sortByDesc('created_at')->reverse();
        foreach($messages as $message){
            array_push($m, $message);
        }

        if(count($m) == 1){
            return response()->json([$m]);
       }else{
            return response()->json($m);
         }
        //coverte messages to array


        //check if user has messages
        return response()->json($messages, 200);
        $messages = Message::where('user_id', $user_id)->get();
        
    }

    public function sendMessages(Request $request){
        error_log($request->email);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        error_log("HOLA SENDING");

        $user_id = User::where('email', $request->email)->first()->id;
        //add message to database
        $message = new Message();
        $message->user_id = $user_id;
        $message->message = $request->message;
        $message->save();
        return response()->json(['message' => 'success'], 200);

    }
}
