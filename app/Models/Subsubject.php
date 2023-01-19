<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubject extends Model
{
    use HasFactory;
     protected $fillable = [
        'subject_name',
        'user_id',
        'subsubject_name',
        'slug',
        'body',
        'description',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
