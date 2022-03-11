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
                            <p>Welcome User! </p>
                            <h5> @auth
                         {{        Auth::user()->name}}
                            @endauth </h5>
                            <div class="profile_info_details">
                                {{-- <a href="#">View Profile <i class="ti-user"></i></a> --}}
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
        <div class="row justify-content-center">
            <div class="col-12">
            <div class="QA_section">
            <div class="white_box_tittle list_header">
            <h4>Package History</h4>
            <div class="box_right d-flex lms_block">
            <div class="serach_field_2">
            <div class="search_inner">
            
            </div>
            </div>
            {{-- <div class="add_button ml-10">
            <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1">Add New</a>
            </div> --}}
            </div>
            </div>
            <div class="QA_table ">
            
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table lms_table_active dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 972px;">
            <thead>
            <tr role="row">
                 <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 96px;" aria-label="Lesson: activate to sort column ascending">Plan Name</th>
                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Enrolled: activate to sort column ascending">Date</th>
                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label="Price: activate to sort column ascending">Time</th>
                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 74px;" aria-label="Status: activate to sort column ascending">Status</th>
                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 74px;" aria-label="Status: activate to sort column ascending">Delete</th></tr>

            </thead>
            <tbody>
            
            
            
            
            
            
            
            
            
            @foreach ($users->subscription as $data)
                

            @foreach ($data->booking_list as $item)
                
            
            
            <tr role="row" class="odd hide_{{$item->id}}">
               
             <td>{{ $data->plans->name }}</td>   
          
            <td>{{ $item->slot_date }}</td>
            <td>{{$item->slot_time}}</td>
        
            <td>
                @if ($item->status == 'pending')

                <a href="{{ route('booking.edit',$item->id)}}" class="status_btn_pending">Pending</a>
                
                @else
                <a href="#" class="status_btn">Complete</a>
                @endif
                
            
            </td>

            <td>
                @if ($item->status == 'pending')

                <a href="javascript:void(0)" id="{{$item->id}}" onclick="delete_booking({{$item->id}})" class="status_btn_pending delete">Delete</a>
                
   
                @endif
            </td>
            </tr> 
            @endforeach
         
                
            @endforeach
        
        </tbody>
            </table>
            
         </div>
            </div>
            </div>
            </div>
            </div>



          
       




        </div>
    </div>
</div>

<!-- footer part -->
 @include('layouts.footer')
</section>
@endsection

@section('sectionFooter')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script>
    
   
  function delete_booking(id) {
    var token = $("meta[name='csrf-token']").attr("content");

   $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   
   $.ajax({

url: "/user/delete-booking/"+id,
type: "DELETE",
data: {
            "id": id,
            "_token": token,
        },

 
cache: false,

success: function(response,responseText,xhr){
    console.log(xhr.responseText + xhr);


  
        displayMessage(response.success);
    $('.hide_'+id).hide();
   
   
    
},    error: function(response){
  //  console.log(response);
    failMessage(response.statusText);

}
   });
   

//var deleteid = $(this).attr('id');
    

             
function displayMessage(message) {
        toastr.success(message, 'Booking History');
    } 

    function failMessage(message) {
        toastr.error(message, 'Booking History');
    } 


    }
    </script>
@endsection
