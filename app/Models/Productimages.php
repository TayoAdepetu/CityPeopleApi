<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimages extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_image_path',
        'user_id',
        'product_name_slug',
        'image_public_id',
        
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
