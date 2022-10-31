<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bizdirectory extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_name',
        'email',
        'location',
        'description',
        'phone',
        'user_id',
        'website',
        'established',
        'slug',
        'registered_here',
        'number_of_employees',
    ];
}
