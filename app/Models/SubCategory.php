<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
 protected $table= 'sub_categories';

    public $fillable = ['name','category_id'];


    public function package() {
        return $this->hasMany(Package::class,'subcategory_id','id');
    }
}
