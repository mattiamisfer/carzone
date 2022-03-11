<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\Price;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //


    public function cars(Request $request) {
        $prices = Price::where('package_id','=',$request->id)->get();
        return response()->json(['success'=>$prices]);

    }

    public function find_car_id($id) {
        $car = SubCategory::find($id);
        return response()->json(['success' => $car]);
    }

    public function ajax_get_holidays() {

        $holidays = Holiday::all();

        $results= [];
        foreach($holidays as $holiday) {
            $results [] =    Carbon::parse($holiday->start)->format('d-m-Y'); 

        }

        return response()->json($results);

    }



    public function subcat(Request $request) {
       
        $subcat = SubCategory::where('category_id','=',$request->id)->get();
        return response()->json(['success' => $subcat]);
    }
}
