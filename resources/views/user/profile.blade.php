@extends('layouts.user')
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
          <h3>Edit Profile</h3>

          @if (Session::has('success'))

          <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
          </div>
          @endif
          @if (Session::has('failure'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('failure') }}
          </div>
       @endif
          

          <form action="{{ route('user.profile.save')}}" class="" method="POST">
            @csrf
              <div class="row">
                <div class="col-lg-8">
                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Name..</label>
                            <input name="name" class="form-control" id=""  value="{{$user->name}}">
                        </div>
                        @error('name')
                       <p class="red" style="color: red">{{$message}}</p>                            
                        @enderror

                      
                    </div>

                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Email</label>
                            <input name="email" class="form-control" id=""  value="{{$user->email}}">
                        </div>
                        @error('email')
                        <p class="red" style="color: red">{{$message }}</p>                            
                         @enderror
                    </div>

                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Mobile</label>
                            <input name="mobile" class="form-control" id=""  value="{{$user->mobile}}">
                        </div>
                        @error('mobile')
                        <p class="red" style="color: red">{{$message}}</p>                            
                         @enderror
                    </div>

                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Address</label>
                            <textarea name="address" id="" cols="30" rows="3" class="form-control">{{$user->address}}
                            </textarea>
                        </div>
                        @error('address')
                        <p class="red" style="color: red">{{$message}}</p>                            
                         @enderror
                    </div>

                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Passowrd</label>
                            <input name="password" class="form-control" id=""  value="">
                        </div>
                        @error('password')
                        <p class="red" style="color: red">{{$message}}</p>                            
                         @enderror
                    </div>
                    <div class="white_box ">
                        <div class="input_wrap  mb_5">
                            <label for="#">Confirm Password Passowrd</label>
                            <input name="password_confirmation" class="form-control" id=""  value="">
                        </div>
                        @error('password_confirmation')
                        <p class="red" style="color: red">{{$message}}</p>                            
                         @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
          </form>

          
         
      </div>
  </div>

  @include('layouts.footer')
  
</section>
@endsection
