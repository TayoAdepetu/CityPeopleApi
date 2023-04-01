<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

//use App\Models\Post;
//use App\Models\Bizdirectory;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'phone_number',
        'user_image',
        'business_name',
        'business_name_slug',
        'scope',
        'email_verified_at',
        'is_verified',
        'biz_logo',
    ];

    protected $table = "users";


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function bizdirectory(){
        return $this->hasOne(Bizdirectory::class, 'business_name_slug', 'business_name_slug');
    }
    
    public function products(){
        return $this->hasMany(Bizdirectoryproducts::class);
    }

    public function faqs(){
        return $this->hasMany(Faqs::class);
    }

    public function jobs(){
        return $this->hasMany(Jobsdirectory::class);
    }

    public function worktime(){
        return $this->hasOne(WorkingHours::class);
    }

    public function messages(){
    return $this->hasMany(Message::class);
}

    public function bizmessengers(){
    return $this->hasMany(BizMessengers::class);
    }

    public function afrimages(){
    return $this->hasMany(Afrimages::class);
    }

    public function productimages(){
    return $this->hasMany(Productimages::class);
    }

}
