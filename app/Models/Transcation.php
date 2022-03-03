<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcation extends Model
{
    use HasFactory;

    public $fillable = [
        'mobile',
        'name',
        'status',
        'start',
        'end',
        'payment_mode',
        'card_name',
        'amount',
        'user_id',
        'plan_id',
        'subcription_id',

    ];

    public function users() {
        return    $this->belongsTo(User::class,'user_id','id');
         }
     
         public function plan() {
             return $this->belongsTo(Plans::class,'plan_id','id');
         }

         public function subscribe() {
             return $this->belongsTo(Subcription::class,'subcription_id','id');
         }
}
