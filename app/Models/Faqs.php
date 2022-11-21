<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Bizdirectory;

class Faqs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question',
        'answer',
    ];

    protected $table = "faqs";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
