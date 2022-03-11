<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable= ['user_id','slot_date','slot_time','package_id','price_id','location_id','status'];
     

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    

    public function location() {
        return $this->belongsTo(Location::class,'location_id','id');
    }

    public function package() {
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function prices() {
        return $this->belongsTo(Price::class,'price_id','id');
    }

    public function users() {
        return    $this->belongsTo(User::class,'user_id','id');
         }


         public function subs() {
             return $this->belongsTo(Subcription::class,'subscription_id','id');
         }
}
