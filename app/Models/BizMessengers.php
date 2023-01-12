<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BizMessengers extends Model
{
    use HasFactory;
    protected $fillable = ['receiver_id', 'user_id'];


    public function user(){
        return $this->hasMany(User::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
