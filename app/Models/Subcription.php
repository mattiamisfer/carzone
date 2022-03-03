<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subcription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','plan_id','start_time','end_time','num_of_wash','subscription_id'];





    public function plans() {
        return $this->belongsTo(Plans::class,'plan_id','id');
    }

    public function booking() {
        return $this->hasMany(Booking::class,'subscription_id','id')->where('slot_date', '<',Carbon::now())->where('user_id','=',Auth::user()->id);

    }

    
    public function upcomming() {
        return $this->hasMany(Booking::class,'subscription_id','id')->where('slot_date', '>',Carbon::now())->where('user_id','=',Auth::user()->id);

    }
}
