<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Bizdirectory;

class Myproducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_name_slug',
        'user_id',
        'description',
        'delivery_days',
        'more_pictures',
        'FAQs_pictures',
        'reviews_pictures',
        'landing_page_title',
        'headline_support',
        'price',
    ];

    protected $table = "myproducts";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function myproductimages(){
        return $this->hasMany(Myproductimages::class, 'product_name_slug', 'product_name_slug');
    }
}
