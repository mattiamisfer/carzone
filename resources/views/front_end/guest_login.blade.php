@extends('layouts.app')

@section('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>
<style>
    container-fluid {
        padding-top: 120px !important;
        padding-bottom: 120px !important
    }

    .card {
        box-shadow: 0px 4px 8px 0px #7986CB
    }

    input {
        padding: 10px 20px !important;
        border: 1px solid #000 !important;
        border-radius: 10px;
        box-sizing: border-box;
        background-color: #616161 !important;
        color: #fff !important;
        font-size: 16px;
        letter-spacing: 1px;
        width: 280px
    }

    input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #512DA8;
        outline-width: 0
    }

    ::placeholder {
        color: #fff;
        opacity: 1
    }

    :-ms-input-placeholder {
        color: #fff
    }

    ::-ms-input-placeholder {
        color: #fff
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    .datepicker {
        background-color: #000 !important;
        color: #fff !important;
        border: none;
        padding: 10px !important

    }

    .datepicker-dropdown:after {
        border-bottom: 6px solid #000
    }

    thead tr:nth-child(3) th {
        color: #fff !important;
        font-weight: bold;
        padding-top: 20px;
        padding-bottom: 10px
    }

    .dow,
    .old-day,
    .day,
    .new-day {
        width: 40px !important;
        height: 40px !important;
        border-radius: 0px !important
    }

    .old-day:hover,
    .day:hover,
    .new-day:hover,
    .month:hover,
    .year:hover,
    .decade:hover,
    .century:hover {
        border-radius: 6px !important;
        background-color: #eee;
        color: #000
    }

    .active {
        border-radius: 6px !important;
        background-image: linear-gradient(#90CAF9, #64B5F6) !important;
        color: #000 !important
    }

    .disabled {
        color: #616161 !important
    }

    .prev,
    .next,
    .datepicker-switch {
        border-radius: 0 !important;
        padding: 20px 10px !important;
        text-transform: uppercase;
        font-size: 20px !important;
        color: #fff !important;
        opacity: 0.8
    }

    .prev:hover,
    .next:hover,
    .datepicker-switch:hover {
        background-color: inherit !important;
        opacity: 1
    }

    .cell {
        border: 1px solid #BDBDBD;
        margin: 2px;
        cursor: pointer
    }

    .cell:hover {
        border: 1px solid #3D5AFE
    }

    .cell.select {
        background-color: #3D5AFE;
        color: #fff
    }

    .fa-calendar {
        color: #fff;
        font-size: 30px;
        padding-top: 8px;
        padding-left: 5px;
        cursor: pointer
    }
    table {
        background-color: white !important;
        border-spacing: 10px;
        border-collapse: collapse;
    }
    .ui-state-default, .ui-widget-content .ui-state-default {
        border: none;
        background: #ffffff !important;
        margin-top: -2px;
        padding: 5px;
    }
    .ui-widget-header {
        background: #fff8f8 !important;
    }
    #confirm {
    height: 44px !important;
        padding: 6px 12px !important;
        font-size: 14px !important;
        line-height: 2.0 !important;
        background-color: rgb(20 226 22 / 79%) !important;
        border: 1px solid #25e075 !important;
    }
    </style>
@endsection
@section('content')
<article class="inner-banner">
    <div class="page-heading">
      <h4>CHECKOUT</h4>
    </div>
    <!--page-heading-->
    <img src="{{ asset('assets/images/insidebanner.jpg')}}" alt="inner banner" class="img-responsive" width="100%"/> </article>
  <!--inner-banner-->
  <div class="bcrumbs" style="margin-bottom:0px;">
    <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li>Contact Us</li>
      </ul>
    </div>
  </div>

  <!-- BLOG CONTENT -->
  <div class="blog-content">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->

        <aside class="col-sm-6 col-md-offset-3 space70">
          <h5 class="heading space40"><span>GUEST CHECKOUT</span></h5>
          @if (Session::has('taken'))

          <div class="alert alert-success" role="alert">
            {{ Session::get('taken') }}
          </div>
          @endif
          <form method="post" action="{{ route('guest.store')}}" id="form" role="form" class="form ">
            @csrf
            <div class="row">
              <div class="col-md-12 space20">
                <input name="name" id="name" class="input-md form-control" placeholder="Name *" maxlength="100"   type="text">
                @error('name')
                <strong class="red">{{ $message }}</strong>
                @enderror
              </div>
              <div class="col-md-12 space20">
                <input name="email" id="email" class="input-md form-control" placeholder="Email *" maxlength="100"  type="email">
                @error('email')
                <strong class="red">{{ $message }}</strong>
                @enderror
            </div>
              <div class="col-md-12 space20">
                <input name="mobile" id="mobile" class="input-md form-control" placeholder="Mobile *" maxlength="100"   type="mobile">
                @error('mobile')
                <strong class="red">{{ $message }}</strong>
                @enderror  
            </div>
              <div class="col-md-12 space20">

                <select name="washloc" id="washloc" class="input-md form-control" maxlength="500" placeholder="Wash Location" >
                <option value="Preferred Wash Location" selected disabled>Preferred Wash Location</option>
              
              @foreach ($locations as $location)
              <option value="{{ $location->id}}">{{ $location->name }}</option> 
              @endforeach
              
                

                </select>
                @error('washloc')
                <strong class="red">{{ $message }}</strong>
                @enderror
              </div>

              <input type="hidden" id="plan" name="plan" value="{{ Session::get('plan_id')}}">
              <input type="hidden" id="type" name="type" value="{{ Session::get('type')}}">
              <div class="col-md-12 space20">

               
                      <div class="card-header bg-dark">
  <input type="text" id="start_datepicker" class="datepicker" placeholder="Pick Date" name="start_date" readonly><span class="fa fa-calendar"></span>                         <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1"> </div>
                      </div>
                      @error('start_time')
                <strong class="red">{{ $message }}</strong>
                @enderror
                      <div class="card-body p-3 p-sm-5">
                          <div class="row text-center mx-0">
                              <div class="col-md-4 col-4 my-1 px-2">
                                  <div class="cell py-1">
                                      <input type="radio" name="start_time" id="start_time" value="9:00AM - 10:00AM">
                                      <label for="start_time">9:00AM - 10:00AM</label>

                                
                                
                                </div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">10:00AM - 11:00AM</div> --}}
                                  <div class="cell py-1">  <input type="radio" name="start_time" id="start_time" value="10:00AM - 11:00AM">
                                  <label for="start_time">10:00AM - 11:00AM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1"></div> --}}
                                  <div class="cell py-1">   <input type="radio" name="start_time" id="start_time" value="11:00AM - 12:00AM">
                                  <label for="start_time">11:00AM - 12:00AM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">12:00NOON - 01:00PM</div> --}}

                                  <div class="cell py-1">   <input type="radio" name="start_time" id="start_time" value="12:00NOON - 01:00PM">
                                  <label for="start_time">12:00NOON - 01:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">01:00PM - 02:00PM</div> --}}
                                  <div class="cell py-1"> <input type="radio" name="start_time" id="start_time" value="01:00PM - 02:00PM">
                                  <label for="start_time">01:00PM - 02:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">02:00PM - 03:00PM</div> --}}
                                  <div class="cell py-1">           <input type="radio" name="start_time" id="start_time" value="02:00PM - 03:00PM">
                                  <label for="start_time">02:00PM - 03:00PM</label></div>
                              </div>
                          </div>
                          <div class="row text-center mx-0">
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">03:00PM - 04:00PM</div> --}}
                                  <div class="cell py-1">  <input type="radio" name="start_time" id="start_time" value="03:00PM - 04:00PM">
                                  <label for="start_time">03:00PM - 04:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">04:00PM - 05:00PM</div> --}}
                                  <div class="cell py-1">   <input type="radio" name="start_time" id="start_time" value="04:00PM - 05:00PM">
                                  <label for="start_time">04:00PM - 05:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">05:00PM - 06:00PM</div> --}}
                                  <div class="cell py-1">     <input type="radio" name="start_time" id="start_time" value="05:00PM - 06:00PM">
                                  <label for="start_time">05:00PM - 06:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">06:00PM - 07:00PM</div> --}}
                                  <div class="cell py-1">         <input type="radio" name="start_time" id="start_time" value="06:00PM - 07:00PM">
                                  <label for="start_time">06:00PM - 07:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">07:00PM - 08:00PM</div> --}}
                                  <div class="cell py-1">    <input type="radio" name="start_time" id="start_time" value="07:00PM - 08:00PM">
                                  <label for="start_time">07:00PM - 08:00PM</label></div>
                              </div>
                              <div class="col-md-4 col-4 my-1 px-2">
                                  {{-- <div class="cell py-1">08:00PM - 09:00PM</div> --}}
                                  <div class="cell py-1">      <input type="radio" name="start_time" id="start_time" value="08:00PM - 09:00PM">
                                  <label for="start_time">08:00PM - 09:00PM</label></div>
                              </div>
                          </div>
 
                      </div>
                 
              </div>
              <div class="col-md-12 space20">
        
              <input name="avail" id="butsave" class="input-md form-control" type="submit" value="Check Availability">
               {{-- <div id="confirm" style="display:none;"></div>
                </select> --}}
              </div>
            </div>
            <button type="button"  class="btn-black" id="checkout" style="display:none;"> Proceed to Checkout</button>
          </form>
        </aside>
        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="google-map ">
            <div id="map-canvas"></div>
          </div>
          <div class="space60"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix space20"></div>
  <!---contents-section--->
  <br />
  <br />
  <!-- FOOTER -->
@endsection

@section('js')
<script type="text/javascript">
    // Call this function once the rest of the document is loaded
function loadAddThis() {
addthis.init()
}
$(document).ready(function(){

$('.datepicker').datepicker({
format: 'dd-mm-yyyy',
autoclose: true,
startDate: '0d'
});

$('.cell').click(function(){
$('.cell').removeClass('select');
$(this).addClass('select');
});

});
// $('#avail').click(function(){
// //alert("hi");
// $('#confirm').show();
// $('#confirm').text('This slot is available');
// $('#avail').hide();
// $('#checkout').show();
// });

</script>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

@endsection
