<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use App\Models\Subcription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakcageController extends Controller
{
    //

    public function index() {


        // $users = User::with(['subscription.plans','subscription.booking'])->where('id','=',Auth::user()->id)->first();
        //  $users;

        

     if(Auth::user()) {
           $subs  = Subcription::with(['plans','booking'])->withCount(['plans','booking'])->where('user_id','=',Auth::user()->id)
        ->where('end_time', '>', Carbon::now())
        ->first();

         
     }

     else {
         $subs = '';
     }

   //     return $subs->count();
   
         $plans = Plans::orderBy('id', 'ASC')->get();

        return view('front_end.package',compact('plans','subs'));
    }
}
