<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }

    public function about() {
        return view('front_end.about');
    }


    public function services() {
        return view('front_end.centres');

    }

    public function events() {
        return view('front_end.events');
    }

    public function contact() {
        return view('front_end.contact');
    }

    public function proceed() {
        return view('front_end.proceed');
    }
}
