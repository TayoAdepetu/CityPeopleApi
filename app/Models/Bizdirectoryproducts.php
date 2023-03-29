<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Bizdirectory;

class Bizdirectoryproducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_name_slug',
        'user_id',
        'description',
        'location',
        'product_id',
        'price',
    ];

    protected $table = "bizdirectoryproducts";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productimages(){
        return $this->hasMany(Productimages::class, 'product_name_slug', 'product_name_slug');
    }
}
