@extends('layouts.user')
@section('headerSection')


@endsection
@section('content')
<section class="main_content dashboard_part">
    <!-- menu  -->
<div class="container-fluid no-gutters">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area">
                        <div class="search_inner">

                        </div>
                    </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        {{-- <li>
                            <a href="#"> <img src="img/icon/bell.svg" alt=""> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="img/icon/msg.svg" alt=""> </a>
                        </li> --}}
                    </div>
                    <div class="profile_info">
                        <img src="{{ asset('assets/profile.png')}}" alt="#">
                        <div class="profile_info_iner">
                            <p>Welcome User!</p>
                            <h5>@auth
                                {{Auth::user()->name}}
                            @endauth</h5>
                               <div class="profile_info_details">
                                <a href="{{ route('user.profile')}}">Edit Profile <i class="ti-settings"></i></a>

                                {{-- <a href="#">Change Password <i class="ti-settings"></i></a> --}}
                                <a href="{{ route('logout')}}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                >Log Out <i class="ti-shift-left"></i></a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ menu  -->
  <div class="main_content_iner ">
      <div class="container-fluid plr_30 body_white_bg pt_30">
          <h3>Book your Slot</h3>
          <form method="POST">
          <div class="row ">
              <div class="col-lg-4">
                  <div class="white_box mb_30">
                      <div class="input_wrap common_date_picker mb_20">
                          <label for="#">Start date</label>
                          <input name="start_date"  autocomplete="off" required class="input_form" id="start_datepicker" placeholder="Pick a start date">
                      </div>
                  </div>
              </div>


              <div class="col-lg-4">
                <div class="white_box mb_30">
                    <div class="input_wrap common_date_picker mb_20">
                        <label for="#">Start date</label>
                <select name="start_time" id="start_time" required class="form-control with-icon" data-validetta="required">
                    <option selected="" value="">Drop In Time</option>
                    <option value="9:00AM - 10:00AM">9:00AM - 10:00AM</option>
                    <option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                    <option value="11:00AM - 12:00AM">11:00AM - 12:00AM</option>
                    <option value="12:00NOON - 01:00PM">12:00NOON - 01:00PM</option>
                    <option value="01:00PM - 02:00PM">01:00PM - 02:00PM</option>
                    <option value="02:00PM - 03:00PM">02:00PM - 03:00PM</option>
                    <option value="03:00PM - 04:00PM">03:00PM - 04:00PM</option>
                    <option value="04:00PM - 05:00PM">04:00PM - 05:00PM</option>
                    <option value="05:00PM - 06:00PM">05:00PM - 06:00PM</option>
                    <option value="06:00PM - 07:00PM">06:00PM - 07:00PM</option>
                    <option value="07:00PM - 08:00PM">07:00PM - 08:00PM</option>
                    <option value="07:00PM - 08:00PM">07:00PM - 08:00PM</option>
                 
                </select>
                    </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="white_box mb_30">
                    <div class="input_wrap common_date_picker mb_20">
                        <label for="#">Location</label>
                        <select name="location_id" id="location_id" class="form-control with-icon" required>
                            <option>Choose Location</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id}}">
                                {{ $location->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>
              </div>




               <div class="col-lg-6">
                  <div class="white_box mb_30">
                      <div class="input_wrap common_date_picker mb_20">
                          <label for="#">Service Station</label>
                         <select class="form-control choose_time" name="package" id="package" required>
                             <option >Choose your Service station</option>
                             @foreach ($packages as  $package)
                             <option value="{{$package->id}}">{{$package->name}} </option>
                             @endforeach

                          </select>
                      </div>
                  </div>
              </div>

              <div class="col-lg-6">
                <div class="white_box mb_30">
                    <div class="input_wrap common_date_picker mb_20">
                        <label for="#">Option</label>
                        <select class="form-control option" name="type" id="type">
                            <option ></option>
                        </select>

                    </div>
                </div>
              </div>

                <div class="col-lg-6" id="messagebox">

                </div>


              <input type="hidden" id="token" value="{{ csrf_token() }}">


          </div>
           <button type="button" id="butsave" class="btn btn-info">Check Availability</button>
           <br>
          </form>
      </div>
  </div>

  @include('layouts.footer')
  
</section>
@endsection


@section('sectionFooter')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" /> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}
 
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css" integrity="sha512-p4vIrJ1mDmOVghNMM4YsWxm0ELMJ/T0IkdEvrkNHIcgFsSzDi/fV7YxzTzb3mnMvFPawuIyIrHcpxClauEfpQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
<script>
  

  

    $(".choose_time").change(function(e){
        $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        e.preventDefault();
        var id = $(this).find("option:selected").val();



        // var name = $("input[name=name]").val();
        // var password = $("input[name=password]").val();
        // var email = $("input[name=email]").val();

       var option =  $('.option');
       option.empty();

        $.ajax({
           type:'POST',
           url:"{{ route('ajaxRequest.post') }}",
          // _token: '{{csrf_token()}}' ,
           data:{id:id},
           success:function(data){
             // alert(data.success);
              console.log(data);
              var data = data.success;
              for (var i = 0; i < data.length; i++) {

                  console.log(data[i].id);
                 option.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
            }
           }
        });

    });









var messagebox = $('#messagebox').hide();

    $('#butsave').on('click', function(e) {

      ///alert('post');

        $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    e.preventDefault();
	//	$("#butsave").attr("disabled", "disabled");
    var SITEURL = "{{ url('/') }}";
		var start_date = $('#start_datepicker').val();
		var start_time = $('#start_time').val();
		var package = $('#package').val();
		var type = $('#type').val();
        var location_id = $('#location_id').val();
        var token = $('#token').val();


        //alert(start_date);
		if(start_date!="" && start_time!="" && package!="" && type!="" && location_id!=""){
			$.ajax({

				url: "/user/booking",
				type: "POST",

				data: {
					start_date: start_date,
					start_time: start_time,
					package: package,
					type: type,
                    token: token,
                    location_id:location_id
				},
				cache: false,

				success: function(dataResult,responseText,xhr){
                    console.log(dataResult);
                    $("#butsave").removeAttr("disabled");
                  //  alert('ajax post');
                    var result = JSON.stringify(dataResult);
					 // var dataResult = JSON.parse(dataResult);
					  if(xhr.status==200){
                        messagebox.show();
                         if(dataResult.status ==1) {
                            

                             messagebox.html("<p style='color:red;'>"+ dataResult.message+" </p>");

                         } else if(dataResult.status == 2)  {
                            messagebox.html("<p style='color:green;'>"+ dataResult.message+" </p>");

                         }
                         else {

                            messagebox.html("<p style='color:green;'>"+ dataResult.message+" </p>");

                         }
					// 	$("#butsave").removeAttr("disabled");
					// 	$('#fupForm').find('input:text').val('');
					// 	$("#success").show();
					// 	$('#success').html('Data added successfully !');
					  }
					  else if(dataResult.statusCode==201){
				//    alert("Error occured !");
					  }

				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
    </script>
 
 <script>
     
        
      var dateToday = new Date();  




      var $j = jQuery.noConflict();

      var unavailableDates = ["03-03-2022", "05-03-2022", "07-03-2022"];

 
 
  

$j(function() {
   
  
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  

$.getJSON("/user/holiday", function(data, status){
    
   // alert("Data: " + data + "\nStatus: " + status);

 

 
 
        $j("#start_datepicker").datepicker({
            format: 'dd-mm-yyyy',
            showOtherMonths: true,
    selectOtherMonths: true,
    autoclose: true,
    changeMonth: true,
    changeYear: true,
    orientation: "bottom left",
    datesDisabled:data,
        });
    });
    });
 
  </script>
@endsection
