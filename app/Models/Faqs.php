<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Bizdirectory;

class Faqs extends Model
{
    use HasFactory;

    protected $fillable = [
        'bizdirectory_id',
        'question',
        'answer',
    ];

    protected $table = "faqs";

    public function bizdirectory(){
        return $this->belongsTo(Bizdirectory::class);
    }
}
