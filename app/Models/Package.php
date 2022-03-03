<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


    protected $fillable = ['name','image','content','category_id'];



  public function category() {
        return $this->hasMany(Category::class);

    }
    public function prices() {
        return $this->hasOne(Price::class);

    }
    public function price() {
        return $this->hasMany(Price::class);

    }
}
