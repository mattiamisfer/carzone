@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-5 col-md-6">Order Id  #{{$order_number}}</div>
        <div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">Amount AED {{ $plans->amount}}</div>
      </div>

                      <div class="row">


                        
                         <form method="post" name="customerData" action="{{ route('guest.response')}}">
                            <div class="col-md-6 col-md-offset-3
                            ">
                            @csrf
                              <div class="form-group">
                                  <label for="exampleInputName">Name</label>
                                  <input type="text" class="form-control" name="billing_name" id="exampleInputName" value="{{ Session::get('name') }}" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email address</label>
                                  <input type="email" name="billing_email" class="form-control" id="exampleInputEmail1" value="{{ Session::get('email') }}" placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="mobileNumber">Mobile Number </label>
                                    <input type="text" name="billing_tel" class="form-control" value="{{ Session::get('mobile') }}">
                                </div>

                                <div class="form-group">
                                    <label for="mobileNumber">Address</label>
                                    <textarea name="billing_address" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>

                                <input type="hidden" name="merchant_id" value="49008"/>
                                <input type="hidden" name="order_id" value="{{$order_number}}"/>
                                <input type="hidden" name="amount" value="{{ $plans->price}}"/>
                                <input type="hidden" name="currency" value="AED"/>
                                <input type="hidden" name="redirect_url" value="{{ route('api.guest.status')}}"/>
                                <input type="hidden" name="cancel_url" value="{{ route('user.status')}}"/>
                                <input type="hidden" name="language" value="EN"/>

                                <input type="hidden" name="merchant_param1" value="{{$plans->price}}">
                                <input type="hidden" name="merchant_param2" value="{{ Session::get('washloc')}}">
                                <input type="hidden" name="merchant_param3" value="{{ Session::get('start_time')}}">
                                <input type="hidden" name="merchant_param4" value="{{ Session::get('start_date')}}">
                                <input type="hidden" name="merchant_param5" value="{{ Session::get('plan_id')}} -{{ Session::get('type')}}">
                                {{-- <input type="text" name="merchant_param6" value=""> --}}

                                <input type="hidden" name="customer_identifier" value="Notes"/>
                                <div class="form-group">

                                    <button class="btn btn-success" type="submit">Checkout</button>
    
                                </div>
                           
                            </div>

                           
                         </form>
                    
                      </div>
                    </div>
 

@endsection