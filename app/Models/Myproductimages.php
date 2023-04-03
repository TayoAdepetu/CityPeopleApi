<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myproductimages extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_image_path',
        'user_id',
        'product_name_slug',
        'image_public_id',
        
    ];

    protected $table = "myproductimages";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function myproducts(){
        return $this->belongsTo(Myproducts::class, 'product_name_slug', 'product_name_slug');
    }
}
