<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';


    protected $fillable = ['name','parent_id'];

    public function subcategory() {
        return $this->hasMany(SubCategory::class,'category_id','id');

    }

    public function childs()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }


    public function parents() {
        return $this->belongsTo(Category::class, 'parent_id');

    }
    public function packagecat() {
        return $this->hasMany(Package::class,'category_id','id');

    }

}


