<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Booking;
use App\Models\GuestCheckout;
use App\Models\Location;
use App\Models\Package;
use App\Models\Plans;
use App\Models\Price;
use App\Models\Transcation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class GuestController extends Controller
{
    //

    public 	function encrypt($plainText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}
	function decrypt($encryptedText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}


    function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length) 
        {       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0)
        {
            $binString=$packedString;
        } 
            
        else 
        {
            $binString.=$packedString;
        } 
            
        $count+=2; 
        } 
          return $binString; 
      } 
    public function response(Request $request)
    
    {
        // For default Gateway
      //  include('Crypto.php');

        $merchant_data='';
        $working_key='E59672C38DD5EE28DF5391E6A7618C09';//Shared by CCAVENUES
        $access_code='AVWH04JB23BJ07HWJB';//Shared by CCAVENUES
        
        foreach ($_POST as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
    
        $encrypted_data= $this->encrypt($merchant_data,$working_key); // Method for encrypting the data.
      //  return $encrypted_data;

     // return view('front_end.payment.payment-proccess',compact('encrypted_data','access_code'));
     $production_url = 'https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;
     return redirect()->away($production_url);

    
    }

    public function index() {

        $locations = Location::all();

         $plan = Price::find(Session::get('type'));
        return view('front_end.guest_login',compact('locations'));
    }


    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'washloc' => 'required',
            'start_date' => 'required',
            'start_time' => 'required'
        ],
        [
            'washloc.required'=> 'Location is Required',
            'start_date.required'=> 'Date is Required',
            'start_time.required'=> 'Time is Required',
        ]
   
        );

        // $request->all();
           $ifbooking = Booking::whereDate('slot_date','=', Carbon::parse($request->start_date)->format('Y-m-d'))->
        where('slot_time','=',$request->start_time)->where('location_id','=',$request->washloc)->count();
        
  // $query =  DB::getQueryLog();

  if($ifbooking == config('app.value')) {
    return back()->with('taken','Sorry Slot is Already Taken');

  } else {

    $data  = [
       'name' => $request->name,
       'email' => $request->email,
       'mobile' => $request->mobile,
       'washloc' => $request->washloc,
       'start_date' => $request->start_date,
       'start_time' => $request->start_time
       

 
    ];

       Session::put('name',$request->name);
        Session::put('email',$request->email);
       Session::put('mobile',$request->mobile);
      Session::put('washloc',$request->washloc);
      Session::put('start_date', date('Y-m-d' , strtotime($request->start_date)));
      Session::put('start_time',$request->start_time);
    //   Session::put('data',$data);

    //   $dat =  Session::get('data');
    //   return $dat[1];

    return Redirect::to('/guest-pay');
   

  }
    }

    public function guest_pay () {

         $plans = Price::find(Session::get('type'));
        $order_number = str_pad($plans->id +  100+2, 8, "0", STR_PAD_LEFT);
     return view('front_end.payment.payment-guest',compact('plans','order_number'));
    }


    public function status() {
        $workingKey='E59672C38DD5EE28DF5391E6A7618C09';		//Working Key should be provided here.
        $encResponse=  $_POST['encResp'];		//This is the response sent by the CCAvenue Server
        $rcvdString=$this->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);
        for($i = 0; $i < $dataSize; $i++) 
        {
          $information=explode('=',$decryptValues[$i]);
          if($i==3)	$order_status=$information[1];
        }
  
  
        $month = 2;
       $num_of_wash = explode('=',$decryptValues[28]);
        $price =explode('=',$decryptValues[26]);
        //$user =explode('=',$decryptValues[27]);
        $mobile =explode('=',$decryptValues[17]);
        $email =explode('=',$decryptValues[18]);
        $name =explode('=',$decryptValues[11]);
        $status =explode('=',$decryptValues[8]);
        $paymentmode =explode('=',$decryptValues[5]);
        $card_name = explode('=',$decryptValues[6]);
        $amount = explode('=',$decryptValues[10]);
        $traking_id = explode('=',$decryptValues[1]);
        $order_id  = explode('=',$decryptValues[0]);

        $location =explode('=',$decryptValues[27]);
        $time =explode('=',$decryptValues[28]);
        $start_date =explode('=',$decryptValues[29]);
        $plan =explode('=',$decryptValues[30]);
        $type =explode('=',$decryptValues[31]);
        if($order_status==="Success")
        {
        // $guest  = new GuestCheckout();
  
        //  $guest->name = $name[1];
        //  $guest->email = '';
        //  $guest->mobile = $mobile[1];
        //  $guest->location = $location[1];
        //  $guest->price = $price[1];
        //  $guest->slot_time = $time[1];
        //  $guest->slot_date = $start_date[1];
        //  $guest->order_id = $order_id[1];

          
        //  $guest->save();

        $trans = new Transcation();

        $trans->mobile = $mobile[1];
        $trans->name =  $name[1];
        $trans->status= $order_status;
        $trans->payment_mode = $paymentmode[1];
        $trans->card_name = $card_name[1];
        $trans->amount  = $amount[1];
        $trans->traking_id = $traking_id[1];
        $trans->order_id = $order_id[1];
        $trans->start = Carbon::now();
        $trans->end = Carbon::now();
        $trans->user_id = 0;
        $trans->plan_id = 0;
        $trans->subcription_id =  0;
        $trans->save();

     //   return $plan[1];
     $mer = explode("-",$plan[1]);


        $booking = new Booking();
              $booking->user_id = 0;
              $booking->slot_date =  $start_date[1];
              $booking->slot_time =   $time[1];
              $booking->package_id = $mer[0];
              $booking->price_id  =   $mer[1];
              $booking->subscription_id = 0;
              $booking->location_id =  $location[1];
              $booking->status = 'pending';
              $booking->save();
      
     //    return $guest->id;
        // return Redirect::to('payment-guest/'.$trans->id);

         $orderplan = Package::with('prices')->where('id','=',$mer[0])->first();


          $order = [
            'name' => $name[1],
           'order_id' => $order_id[1],
          'data' =>  $orderplan
        ];

      //  return $email[1];

     Mail::to($email[1])->send(new OrderShipped($order));


        // for($i = 0; $i < $dataSize; $i++) 
        // {
        //   $information=explode('=',$decryptValues[$i]);
        //       echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr><br/>';
        // }
   return redirect()->route('guest.payment',['id' => $trans->id]);
        } else {
         // return redirect()->to('payment-guest/'.$guest->id);

         return redirect()->to('payment-failed');
        }
  
      
         
          //return view('front_end.payment.payment-success',compact('order_status','dataSize','decryptValues'));
  
     
      }

      public function failed() {

        return view('front_end.payment.failed');
  
      }
      public function payme($id) {
        $trans = Transcation::find($id);
  
   return view('front_end.payment.payment-success-guess',compact('trans'));
  
  
        
         
        
  
        
         
        
      
  
   //return view('front_end.payment.payment-success',compact('order_status','dataSize','decryptValues'));
      }
}
