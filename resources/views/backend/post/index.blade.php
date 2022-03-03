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
                        <li>
                            <a href="#"> <img src="img/icon/bell.svg" alt=""> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="img/icon/msg.svg" alt=""> </a>
                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="img/client_img.png" alt="#">
                        <div class="profile_info_iner">
                            <p>Welcome Admin!</p>
                            <h5>Travor James</h5>
                            <div class="profile_info_details">
                                <a href="#">View Profile <i class="ti-user"></i></a>
                                <a href="#">Edit Profile <i class="ti-settings"></i></a>
                                <a href="#">Change Password <i class="ti-settings"></i></a>
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
                    <div class="card-header">Create Post</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>No</th>
                                <th>Title</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">Read Post</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
            
                        </table>
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
