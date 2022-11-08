<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'description',
        'business_name',
        'business_nam_slug',
        'phone',

    ];
    
}
