<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //


    public function profile() {
        $user = User::find(Auth::user()->id);
       // return $user;

       return view('user.profile',compact('user'));
    }

    public function store(Request $request) {

 
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'password' => 'min:10',
            'password_confirmation' => 'required_with:password|same:password|min:10'
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name.required'=> 'Name is Required', // custom message


           ]
        );

          $user = User::find(Auth::user()->id);
          $user->name = $request->name;
          $user->email = $request->email;
          $user->mobile = $request->mobile;
          $user->address = $request->address;
          $user->password = Hash::make($request->password);

        //  return $request->all();

          if($user->save()) {

            // return 2;
           return back()->with('success','Successfully Updated');
        }else {
              return back()->with('failure','Sorry Some Error');
        }



    }
}
