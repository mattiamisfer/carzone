<?php

namespace App\Http\Middleware;

use App\Models\Transcation;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check()) {
            $usercheck =  User::with(['subscription'])->find(Auth::user()->id);

        //    return $check = Transcation::where('user_id','=',Auth::user()->id)->where('status','=','Success')
        //     ->get();

            if($usercheck->subscription->count() ==1) {

                return $next($request);


            } else {
                return $next($request);
             }
        } else {
            return redirect('home')->with('status','Please Login First');
        }

    }
}
