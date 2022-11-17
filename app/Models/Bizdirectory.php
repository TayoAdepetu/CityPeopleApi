<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Faqs;
use App\Models\WorkingHours;
use App\Models\Bizdirectoryproducts;
use App\Models\Jobsdirectory;

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

    public function faqs(){
        return $this->hasMany(Faqs::class);
    }

    public function worktime(){
        return $this->hasOne(WorkingHours::class);
    }

    public function products(){
        return $this->hasMany(Bizdirectoryproducts::class);
    }

    public function jobs(){
        return $this->hasMany(Jobsdirectory::class);
    }
}
