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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">Mail</div> --}}
                    <div class="card-body">
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
    

                        <form method="post" action="{{ route('user.feedback.store') }}">
                            <div class="input_wrap common_date_picker mb_20">
                                <label for="#">Reason</label>
                            <select class="form-control" name="reason">
                                <option value="">Choose your Reason</option>
                                <option value="Feedback on wash">Feedback on wash</option>
                                <option value="After Service query">After Service query</option>
                                <option value="Package related">Package related</option>
                                </select>
                                @error('reason')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            </div>
                            <div class="form-group">
                                @csrf
                                <label class="label">Feedback </label>
                                {{-- <input type="text" name="title" class="form-control" /> --}}

                                <textarea class="form-control" style="height:300px" name="feedback" placeholder="Feedback"></textarea>
                                @error('feedback')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                           
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Submit"/>
                            </div>
                        </form>
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
