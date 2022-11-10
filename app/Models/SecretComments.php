<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretComments extends Model
{
    use HasFactory;

    protected $fillable = ['comment','reply_id','page_slug','user_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function replies()
    {
        return $this->hasMany('App\Models\SecretComments','id','reply_id');
    }
}
