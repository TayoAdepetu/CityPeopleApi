<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bizdirectoryproducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_name',
        'product_name',
        'product_name_slug',
        'user_id',
        'business_name_slug',
        'description',
        'phone',
        'biz_location'
    ];
}
