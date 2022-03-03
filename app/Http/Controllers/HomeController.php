<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Session;

 
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

    public function store() {
       return redirect()->back();
    }

    public function proceed($id,$type) {

        $id = Session::put('plan_id',$id);
        $type = Session::put('type',$type);


      
        return view('front_end.proceed');
    }



    public function refund() {
        return view('front_end.refund');
    }

    public function terms() {
        return view('front_end.refund');
    }

    public function privacy() {
        return view('front_end.privacy');
    }

}
