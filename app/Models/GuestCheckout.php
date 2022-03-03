<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCheckout extends Model
{
    use HasFactory;
    protected $table='guest_checkouts';
    public $fillable = [
       'name',
       'email',
       'price',
       'mobile',
       'location',
       'slot_time',
       'slot_date',
       'order_id',
    ];
}
