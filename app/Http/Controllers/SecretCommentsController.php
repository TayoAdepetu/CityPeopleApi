<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecretComments;

class SecretCommentsController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate($request, [
        'comment' => 'required',
        'reply_id' => 'filled',
        'page_id' => 'filled',
        'users_id' => 'required',
        ]);

        $comment = SecretComments::create($request->all());

        if($comment)
            return [ "status" => "true","commentId" => $comment->id ];
    }

   public function index($page_slug)
    {
        //
        $comments = SecretComments::where('page_slug',$page_slug)->get();
        $commentsData = [];

        foreach ($comments as $key) {
            $user = User::find($key->user_id);
            $name = $user->name;
            $replies = $this->replies($key->id);
            //$photo = $user->first()->photo_url;
            // dd($photo->photo_url);
            $reply = 0;
          
            if(sizeof($replies) > 0){
                $reply = 1;
            }

            if($comments){
                array_push($commentsData,[
                    "name" => $name,
                    //"photo_url" => (string)$photo,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "reply" => $reply,
                    "replies" => $replies,
                    "date" => $key->created_at->toDateTimeString()
                ]);
            }       
        }

        $collection = collect($commentsData);
        return $collection->sortBy('date');
    }

    protected function replies($commentId)
    {
        $comments = SecretComments::where('reply_id',$commentId)->get();
        $replies = [];

        foreach ($comments as $key) {
            $user = User::find($key->user_id);
            $name = $user->name;
            //$photo = $user->first()->photo_url;

            if($comments){        
                array_push($replies,[
                    "name" => $name,
                    //"photo_url" => $photo,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "date" => $key->created_at->toDateTimeString()
                ]);
        }

        $collection = collect($replies);
        return $collection->sortBy('date');
    }

}

}