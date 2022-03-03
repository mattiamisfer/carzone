<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    //


    public function index() {

        return view('backend.user.index');

    }


    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
        
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'title.required'=> 'Body is Required', // custom message


           ]
       
        );

        $order = [
            'name' => Auth::user()->name,
            'content' => $request->title,
        ];

        $email = Auth::user()->email;
      Mail::to($email)->send(new FeedbackMail($order));

 

      if( count(Mail::failures()) > 0 ) {
        return back()->with('failure','Sorry Some Error');
        // return 2;
      
    }else {
        return back()->with('success','Mail Successfully Sent');   
    }
    }
}
