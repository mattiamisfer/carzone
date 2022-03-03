<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //


    public function services($id) {
             $packages =  Category::with(['subcategory.package','packagecat.price'])
           ->where('id','=',$id)->get();

//return  $packages =  Category::with(['childs','package'])->get();






        //   $packages = Package::with(['prices'])->where('category_id','=',$id)->get();
           $name = Category::find($id);
          

         


     return view('front_end.services',compact('packages','name'));
    }
}
