<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcription;
use App\Models\Transcation;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //



    public function index() {
           $subscriptions = Transcation::with(['users','plan','subscribe'])->orderBy('id','DESC')->get();

         return view('backend.subs.index',compact('subscriptions'));
    }
}
