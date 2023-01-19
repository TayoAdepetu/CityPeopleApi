<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afrimages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_name',
        'image_path',
        'user_id',
        'photo_id',
        'description',
        'category_id',
    ]
}
