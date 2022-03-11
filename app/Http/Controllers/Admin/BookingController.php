<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //


    public function index() {
             $bookings = Booking::with(['location','package','prices','users','subs'])
           ->orderBy('slot_date','ASC')->get();

          return view('backend.booking.index',compact('bookings'));
    }


    public function update(Request $request,$id) {
      try {
        $booking = Booking::find($id);
        $booking->status = $request->status;
        if($booking->save()) {
          return response()->json(['success','Updated Successfully'],200);
        }
      } catch (\Exception $exeption) {

      }
    }

    public function update_status(Request $request,$id) {
      try {
        $booking = Feedback::find($id);
        $booking->status = $request->status;
        if($booking->save()) {
          return response()->json(['success','Updated Successfully'],200);
        }
      } catch (\Exception $exeption) {

      }
    }



}
