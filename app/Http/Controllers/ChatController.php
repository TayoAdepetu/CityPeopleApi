<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Models\Message;
use App\Models\BizMessengers;
use App\Events\ChatMessage;


class ChatController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      // $this->middleware('auth');
   }

    public function index()
    {
    return view('chat');
    }


    //fetch all chats for specific user

   public function fetchChats($currentuser)
    {
        $chats = BizMessengers::with(['user'])->where('user_id', $currentuser)->orWhere('receiver_id', $currentuser)->get();

        return response()->json($chats);
    }

    //get messages for each channel ID
    public function fetchMessages($channel_number){
        $messages = Message::with('user')->where('channel_id', $channel_number)->get();
        return response()->json($messages);
    }
    
   /**
    * Send chat message
    * @param $request
    * @return void
    */
   public function store(Request $request)
   {
       $threadExists = BizMessengers::where(['user_id' => $request->user_id, 'receiver_id' => $request->receiver_id,])->first();
       
       $user = Auth::user();

       if($user){
       if(!$threadExists){
        $thread = BizMessengers::create([
            "user_id" => $request->user_id,
            "receiver_id" => $request->receiver_id,
        ]);

        $message = Message::create([
            "user_id" => $request->user_id,
            "receiver_id" => $request->receiver_id,
            "body" => $request->body,
            "channel_id" => $thread->id,
        ]);

        broadcast(new ChatMessage($user, $message))->toOthers();
        return true;
       }

       $message = Message::create([
        "user_id" => $request->user_id,
        "receiver_id" => $request->receiver_id,
        "body" => $request->body,
        "channel_id" => $threadExists->id,
        ]);

        broadcast(new ChatMessage($user, $message))->toOthers();
        return true;
    }
   }
   
   public function chatPage()
   {

   }
}