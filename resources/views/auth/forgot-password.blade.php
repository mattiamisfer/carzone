@extends('layouts.app')
@section('title','Forgot Password');
@section('content')




<article class="inner-banner">
    <div class="page-heading">
      <h4>Forgot Password</h4>
    </div>
    <!--page-heading-->
    <img src="{{ asset('assets/images/insidebanner.jpg')}}" alt="inner banner" class="img-responsive" width="100%"/> </article>
  <!--inner-banner-->
  <div class="bcrumbs" style="margin-bottom:0px;">
    <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li>Forgot Password</li>
      </ul>
    </div>
  </div>

  <!-- BLOG CONTENT -->
  <div class="blog-content">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->
        <div class="logindiv col-sm-6 col-md-offset-3 space70"
        <aside class="">
       <div class="col-md-12 space20" style="text-align:center;">
                 <h3 style="color:rgb(0, 0, 0);">Forgot Paassword</h3>
              </div>
        </aside>
         <aside class=""  style="margin-top: -50px;">
       <div class="col-md-12 space20" style="text-align:center;">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <form  method="POST" action="{{ route('password.email') }}" id="form" role="form" class="form ">
            <div class="row">
                @csrf

              <div class="col-md-12 space20">
                <input   id="email"
                 class="input-md form-control" placeholder="Email *"
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}"
                  required autocomplete="email" autofocus
                  maxlength="100" required="" type="text">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong style="color: red">{{ $message }}</strong>
                  </span>
              @enderror
              </div>
              



            </div>

            <button type="submit" class="btn-black"> Sent Password Reset Link </button>

            {{-- <a href="{{ route('register')}}">Register</a> --}}
          </form>
          </div>
        </aside>



      </div>
    </div>
  </div>
  <div class="clearfix space20"></div>
  <!---contents-section--->
  <br />
  <br />
  <!-- FOOTER -->
@endsection
