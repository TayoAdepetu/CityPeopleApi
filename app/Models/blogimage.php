<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogimage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_name',
        'image_name_slug',
        'image_path',
        'user_id',
        'public_id',
        'description',
        //'category_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
