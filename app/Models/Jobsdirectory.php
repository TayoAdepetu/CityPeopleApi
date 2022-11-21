<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Bizdirectory;

class Jobsdirectory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'job_slug',
        'salary',
        'location',
        'function',
        'description'
    ];

    protected $table = "jobsdirectories";

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
