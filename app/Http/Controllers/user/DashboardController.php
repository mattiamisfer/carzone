<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Plans;
use App\Models\Subcription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    //      $dashboards  =  User::with(['subscription'])->find(Auth::user()->id);

    //        if($dashboards->subscription->count() ==1) {


    //           $plans = Plans::find($dashboards->subscription[0]->plan_id);
    //        }
          

    //    $used =      Booking::where('user_id','=',Auth::user()->id)->where('subscription_id','=',$dashboards->subscription[0]->id)->get();
       



         $dashboards = User::with(['subscription.booking','subscription.plans','subscription.upcomming'])->where('id','=',Auth::user()->id)->first();
 
   //DB::raw("count(subcriptions.id) as total")

//   return DB::table('subcriptions')

//   ->join('plans', 'subcriptions.plan_id', '=', 'plans.id')
//   ->join('bookings', 'plans.id', '=', 'bookings.plans_id')

// //   ->select('plans.name','plans.amount','plans.duration','plans.times',DB::raw("count(bookings.id) as total"))

//   ->get();
       
   return view('user.index',compact('dashboards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
