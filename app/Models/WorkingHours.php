<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Bizdirectory;

class WorkingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'bizdirectory_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    protected $table = "working_hours";

    public function bizdirectory(){
        return $this->belongsTo(Bizdirectory::class);
    }
}
