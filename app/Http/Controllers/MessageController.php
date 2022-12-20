<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    //Following instructions on: https://appdividend.com/2022/03/01/laravel-vue-chat-application/
    public function index()
    {
        $messages = Message::with(['user'])->get();

        return response()->json($messages);
    }

    public function store(Request $request)
{
     $message = $request->user()->messages()->create([
         'body' => $request->body
     ]);

     return response()->json($message);
}
}
