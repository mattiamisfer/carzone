<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\FeedbackMail;
use App\Models\Feedback;
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
            'feedback' => 'required',
            'reason' => 'required'
        
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'feedback.required'=> 'Feedback is Required', // custom message
            'reason.required' => 'Reason is Required'


           ]
       
        );



        $feedback = new Feedback();
        $feedback->reason = $request->reason;
        $feedback->feedback = $request->feedback;
        $feedback->user_id = Auth::user()->id;
        
 

 

      if( $feedback->save() ) {
        // return 2;
        return back()->with('success','Successfully Created');   

    }else {
        return back()->with('failure','Sorry Some Error');

    }
    }
}
