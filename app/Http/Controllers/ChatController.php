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
       $this->middleware('auth');
   }

   public function index()
    {
        $messages = Message::with(['user'])->get();

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
       
       if(!$threadExists){
        $thread = BizMessengers::create([
            "user_id" => $request->user_id,
            "receiver_id" => $request->receiver_id,
        ]);

        $message = Message::create([
            "user_id" => $request->user_id,
            "receiver_id" => $request->receiver_id,
            "body" => $request->body,
            "channel_id" => $request->channel_id,
        ]);

        broadcast(new ChatMessage($message))->toOthers();
        return response()->json($message);
       }

       $message = Message::create([
        "user_id" => $request->user_id,
        "receiver_id" => $request->receiver_id,
        "body" => $request->body,
        "channel_id" => $request->channel_id,
        ]);

        broadcast(new ChatMessage($message))->toOthers();
        return response()->json($message);
   }
   
   public function chatPage()
   {
       $users = User::take(10)->get();
       return view('chat',['users'=> $users]);
   }
}