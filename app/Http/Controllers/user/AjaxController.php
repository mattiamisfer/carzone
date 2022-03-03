<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //


    public function cars(Request $request) {
        $prices = Price::where('package_id','=',$request->id)->get();
        return response()->json(['success'=>$prices]);

    }

    public function ajax_get_holidays() {

        $holidays = Holiday::all();

        $results= [];
        foreach($holidays as $holiday) {
            $results [] =    Carbon::parse($holiday->start)->format('d-m-Y'); 

        }

        return response()->json($results);

    }
}
