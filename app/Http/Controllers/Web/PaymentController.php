<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\SubscribeMail;
use App\Models\Plans;
use App\Models\Subcription;
use App\Models\Transcation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Softon\Indipay\Facades\Indipay;  
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    //

    public function checkout($id) {

        $order_id = Auth::user()->id;

      $plans = Plans::find($id);

        $order_number = str_pad($plans->id +  1000+$order_id, 8, "0", STR_PAD_LEFT);
      return view('front_end.payment.payment',compact('order_number','plans'));
    }



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
        $working_key='6DC3440A071E133F2F3BB960AB2FFC89';//Shared by CCAVENUES
        $access_code='AVED04JB23BL21DELB';//Shared by CCAVENUES
        
        foreach ($_POST as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
    
        $encrypted_data= $this->encrypt($merchant_data,$working_key); // Method for encrypting the data.
      //  return $encrypted_data;

     // return view('front_end.payment.payment-proccess',compact('encrypted_data','access_code'));
     $production_url = 'https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;
     return redirect()->away($production_url);

    
    }
    public function status() {
      $workingKey='6DC3440A071E133F2F3BB960AB2FFC89';		//Working Key should be provided here.
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
      $plan =explode('=',$decryptValues[26]);
      $user =explode('=',$decryptValues[27]);
      $mobile =explode('=',$decryptValues[17]);
      $name =explode('=',$decryptValues[11]);
      $status =explode('=',$decryptValues[8]);
      $paymentmode =explode('=',$decryptValues[5]);
      $card_name = explode('=',$decryptValues[6]);
      $amount = explode('=',$decryptValues[10]);
      $traking_id = explode('=',$decryptValues[1]);
      $order_id  = explode('=',$decryptValues[0]);
      $email =explode('=',$decryptValues[18]);
      if($order_status==="Success")
      {
      $subrciption = new Subcription();

       $subrciption->user_id = $user[1];
       $subrciption->plan_id =  $plan[1];
       $subrciption->start_time = Carbon::now();
       $subrciption->end_time = Carbon::now()->addMonth($month);
       $subrciption->num_of_wash = $num_of_wash[1];
      
       $subrciption->save();
      


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
       $trans->end = Carbon::now()->addMonth($month);
       $trans->user_id = $user[1];
       $trans->plan_id = $plan[1];
       $trans->subcription_id = $subrciption->id ?? 0;
       $trans->save();

        $plans = Plans::find($plan[1]);


      $order = [
      'name' => $name[1],
       
     'order_id' => $order_id[1],
    'data' =>  $plans
  ];

//  return $email[1];

               Mail::to($email[1])->send(new SubscribeMail($order));
       
        //return view('front_end.payment.payment-success',compact('order_status','dataSize','decryptValues'));

    return redirect()->to('/user/payment/'.$trans->id);
}
else {
  return redirect()->to('/user/payment-failed');
}
    }

    public function failed() {

      return view('front_end.payment.failed');

    }
    public function payment($id) {
     $trans = Transcation::find($id);

    return view('front_end.payment.payment-success',compact('trans'));


      
       
      

      
       
      
    

 //return view('front_end.payment.payment-success',compact('order_status','dataSize','decryptValues'));
    }
}
