<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
//use App\Models\Faqs;
//use App\Models\WorkingHours;
//use App\Models\Bizdirectoryproducts;
//use App\Models\Jobsdirectory;

class Bizdirectory extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'description',
        'business_name_slug',
        'website',
        'established',
        'number_of_employees',
        'verified',
    ];

    protected $table = "bizdirectories";

    public function user(){
        return $this->belongsTo(User::class, 'business_name_slug', 'business_name_slug');
    }

}
