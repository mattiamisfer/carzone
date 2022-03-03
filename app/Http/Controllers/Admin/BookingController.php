<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //


    public function index() {
             $bookings = Booking::with(['location','package','prices','users','subs'])
           ->orderBy('slot_date','ASC')->get();

          return view('backend.booking.index',compact('bookings'));
    }
}
