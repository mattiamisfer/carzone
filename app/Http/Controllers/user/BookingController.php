<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Location;
use App\Models\Package;
use App\Models\Price;
use App\Models\Subcription;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $packages = Package::with(['price'])->where('name','!=','video')->get();
        $locations = Location::all();
        //$dashboards  =  User::with(['subscription'])->find(Auth::user()->id);

        return view('user.book',compact('packages','locations'));
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

        //return $request->all();

        // $booking = new Booking();
        // $booking->user_id = Auth::user()->id;
        // $booking->slot_date = $request->start_date;
        // $booking->slot_time = $request->start_time;
        // $booking->package_id = $request->package;
        // $booking->price_id  = $request->type;
     //   DB::enableQueryLog();


   

         $ifbooking = Booking::whereDate('slot_date','=', Carbon::parse($request->start_date)->format('Y-m-d'))->
         where('slot_time','=',$request->start_time)->where('package_id','=',$request->package)->count();
    
   // $query =  DB::getQueryLog();

   if($ifbooking == config('app.value')) {
       return response()->json(['status'=>1,'message'=> 'Sorry Slot Already Taken'],200);
   } else {
        $subscription = Subcription::where('user_id','=',Auth::user()->id)->whereDate('end_time', '>', Carbon::now())
    ->first();
    $booking = new Booking();
              $booking->user_id = Auth::user()->id;
              $booking->slot_date = Carbon::parse($request->start_date)->format('Y-m-d');
              $booking->slot_time =  $request->start_time;
              $booking->package_id = $request->package;
              $booking->price_id  = $request->type;
              $booking->subscription_id = $subscription->id;
              $booking->location_id = $request->location_id;
              $booking->status = 'pending';

             if($booking->save()) {
                 
                return response()->json(['status'=>2,'message'=> 'Successfully Booked your Slot'],200);
             }else {
                   return response()->json(['status'=>3,'message'=> 'Sorry Some Error'],200);
             }

             
   }


              //  $query = DB::getQueryLog();




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

        $prices = Price::where('package_id','=',$id)->get();
        return  $prices;
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
           $booking = Booking::find($id);
        $packages = Package::with(['price'])->where('name','!=','video')->get();
        $locations = Location::all();
        //$dashboards  =  User::with(['subscription'])->find(Auth::user()->id);

        return view('user.edit',compact('packages','locations','booking'));
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

     
   

        $ifbooking = Booking::whereDate('slot_date','=', Carbon::parse($request->start_date)->format('Y-m-d'))->
        where('slot_time','=',$request->start_time)->where('package_id','=',$request->package)->count();
   
  // $query =  DB::getQueryLog();

  if($ifbooking == config('app.value')) {
      return response()->json(['status'=>1,'message'=> 'Sorry Slot Already Taken'],200);
  } else {
       $subscription = Subcription::where('user_id','=',Auth::user()->id)->whereDate('end_time', '>', Carbon::now())
   ->first();
   $booking =  Booking::find($id);
             $booking->user_id = Auth::user()->id;
             $booking->slot_date = Carbon::parse($request->start_date)->format('Y-m-d');
             $booking->slot_time =  $request->start_time;
             $booking->package_id = $request->package;
             $booking->price_id  = $request->type;
             $booking->subscription_id = $subscription->id;
             $booking->location_id = $request->location_id;
            if($booking->save()) {
                
               return response()->json(['status'=>2,'message'=> 'Successfully Booked your Slot'],200);
            }else {
                  return response()->json(['status'=>3,'message'=> 'Sorry Some Error'],200);
            }
    }
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

     //   return response()->json(['success'  => 1],200);

     try {
        $delete = Booking::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Successfully Deleted'],200);

     } catch(\Exception $exception) {
        $errormsg = 'No Customer to de!' . $exception->getCode();

        return response()->json(['fail'=> $errormsg]);

     }
 

    
 
    }
}
