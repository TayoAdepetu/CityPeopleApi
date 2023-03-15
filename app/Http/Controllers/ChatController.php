<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Models\Message;
use App\Models\BizMessengers;
use App\Events\ChatMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\Chat;




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
            "message" => $request->message,
            "channel_id" => $thread->id,
        ]);

        $name = $user->name;
        $email = $user->email;

        try{
            //https://mailtrap.io/blog/send-email-in-laravel/
            //The email sending is done using the to method on the Mail facade
            Mail::to($email)->send(new Chat($name, $message));
            event(new ChatMessage($user, $message));
            
            return response()->json(['success'=> true, 'message'=> 'Message Sent!']);
        } catch(\Exception $error){
                    return throw $error;
        }
       }

       $message = Message::create([
        "user_id" => $request->user_id,
        "receiver_id" => $request->receiver_id,
        "body" => $request->body,
        "channel_id" => $threadExists->id,
        ]);

        $name = $user->name;
        $email = $user->email;

        try{
            //https://mailtrap.io/blog/send-email-in-laravel/
            //The email sending is done using the to method on the Mail facade
            Mail::to($email)->send(new Chat($name, $message));
            event(new ChatMessage($user, $message));
            return response()->json(['success'=> true, 'message' => 'Message Sent!']);
        } catch(\Exception $error){
            return response()->json(['success'=> false, 'message'=> 'Message not sent.']);
        }
    }
   }
   
   public function chatPage()
   {
    
   }
}