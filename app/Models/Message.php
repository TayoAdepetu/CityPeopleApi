<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
    use HasFactory;


    public function getSelfMessageAttribute()
{
    return $this->user_id === Auth::user()->id;
}

    protected $fillable = ['body', 'receiver_id', 'user_id', 'channel_id'];

    protected $appends = ['selfMessage'];

    public function user()
{
   return $this->belongsTo(User::class);
}
}
