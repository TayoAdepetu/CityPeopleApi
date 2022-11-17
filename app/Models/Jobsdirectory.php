<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Bizdirectory;

class Jobsdirectory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'bizdirectory_id',
        'job_slug',
        'salary',
        'location',
        'function',
        'description'
    ];

    protected $table = "jobsdirectories";

    public function bizdirectory(){
        return $this->belongsTo(Bizdirectory::class);
    }
    
}
