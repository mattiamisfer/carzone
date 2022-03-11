@extends('layouts.app')
@section('title','Reset Password');

@section('content')


<article class="inner-banner">
    <div class="page-heading">
      <h4>Reset Password</h4>
    </div>
    <!--page-heading-->
    <img src="{{ asset('assets/images/insidebanner.jpg')}}" alt="inner banner" class="img-responsive" width="100%"/> </article>
  <!--inner-banner-->
  <div class="bcrumbs" style="margin-bottom:0px;">
    <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li>Reset Password</li>
      </ul>
    </div>
  </div>

  <!-- BLOG CONTENT -->
  <div class="blog-content">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->

        <aside class="col-sm-6 col-md-offset-3 space70">
          <h5 class="heading space40"><span>Reset Password</span></h5>
          <form  method="POST" action="{{ route('password.update') }}" id="form" role="form" class="form ">
            <div class="row">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

              <div class="col-md-12 space20">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
              <div class="col-md-12 space20">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>

               <div class="col-md-12 space20">
                <input id="password-confirm" placeholder="Re Enter Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

               </div>

              {{-- <div class="col-md-12 space20">
                <select name="package" id="package" class="input-md form-control" maxlength="100" placeholder="Mobile *" >
                <option value="Gold">Gold</option>
                <option value="Silver">Silver</option>
                <option value="GOLD CERAMIC SALOON">GOLD CERAMIC SALOON</option>
                <option value="SILVER CERAMIC SALOON">SILVER CERAMIC SALOON</option>

                </select>
              </div> --}}
            </div>


            <button type="submit" class="btn-black"> Reset Password</button>
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
