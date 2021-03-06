<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile','address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function subscription() {
        return $this->hasMany(Subcription::class)->whereDate('end_time', '>', Carbon::now());

    }

    public function subs() {
        return $this->hasOne(Subcription::class)->whereDate('end_time', '>', Carbon::now());

    }


    public function sub() {
        return $this->belongsTo(Subcription::class)->whereDate('end_time', '>', Carbon::now());
    }


    public function bookings() {
        return $this->hasMany(Booking::class,'user_id','id');
    }

    public function posts() {
  
        return $this->hasMany(Post::class);
     
    }
}
