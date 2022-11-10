<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectoryReviews extends Model
{
    use HasFactory;

    protected $fillable = ['comment','reply_id','page_slug','user_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function replies()
    {
        return $this->hasMany('App\Models\DirectoryReviews','id','reply_id');
    }
}
