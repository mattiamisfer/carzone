@extends('layouts.app')
@section('title','Packages')
@section('content')

<article class="inner-banner">
    <div class="page-heading">
      <h4>PACKAGES</h4>
    </div>
    <!--page-heading-->
    <img src="{{ asset('assets/images/insidebanner.jpg')}}" alt="inner banner" class="img-responsive" width="100%"/> </article>
  <!--inner-banner-->
  <div class="bcrumbs">
    <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li>Packages</li>
      </ul>
    </div>
  </div>

  <div class="account-wrap">
    <div class="container">
      <div class="row">

        @if(Auth::user())
        @if($subs && $subs->count() > 0)
        @if ($subs->num_of_wash == $subs->booking_count )
             
  
        @foreach ($plans as $plan)



        <div class="col-md-3 col-sm-12 checkout-steps1">
          <div style="">
            <div id="accordion">
              <div class="accordion-content border-none default">
                <div class="details-box">
                <p class="text-justify text-uppercase"> <strong>{{$plan->name}} </strong></p>
                <hr>
                  <h3 class="project-head"><strong>AED {{ floatval($plan->amount)}} .VAT</strong></h3>
                  <hr>

                  {!! $plan->description!!}
               


                  @if (empty(Auth::user()->id))
                  <a href="{{ route('login')}}">
                    <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                    </a>

                    @else
                    <a href="{{ route('user.checkout',['id' => $plan->id])}}">
                        <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                        </a>
                  @endif



                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach

      
 
        
        @else
                   <h2> You already have plan  go to <a href="{{ route('dashboard.index')}}">Dashboard</a></h2>
      
    
      @endif

      @else

      @foreach ($plans as $plan)



      <div class="col-md-3 col-sm-12 checkout-steps1">
        <div style="">
          <div id="accordion">
            <div class="accordion-content border-none default">
              <div class="details-box">
              <p class="text-justify text-uppercase"> <strong>{{$plan->name}} </strong></p>
              <hr>
                <h3 class="project-head"><strong>AED {{$plan->amount}} .VAT</strong></h3>
                <hr>

                {!! $plan->description!!}
             


                @if (empty(Auth::user()->id))
                <a href="{{ route('login')}}">
                  <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                  </a>

                  @else
                  <a href="{{ route('user.checkout',['id' => $plan->id])}}">
                      <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                      </a>
                @endif



              </div>
            </div>
          </div>
        </div>
      </div>

      @endforeach
      @endif

          @else
          @foreach ($plans as $plan)



          <div class="col-md-3 col-sm-12 checkout-steps1">
            <div style="">
              <div id="accordion">
                <div class="accordion-content border-none default">
                  <div class="details-box">
                  <p class="text-justify text-uppercase"> <strong>{{$plan->name}} </strong></p>
                  <hr>
                    <h3 class="project-head"><strong>AED {{$plan->amount}} .VAT</strong></h3>
                    <hr>
  
                    {!! $plan->description!!}
                 
  
  
                    @if (empty(Auth::user()->id))
                    <a href="{{ route('login')}}">
                      <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                      </a>
  
                      @else
                      <a href="{{ route('user.checkout',['id' => $plan->id])}}">
                          <button type="button" class="btn btn-warning photo-gallery"  >Book Now</button>
                          </a>
                    @endif
  
  
  
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          @endforeach
        @endif


     






        </div>
      <!--row-->
    </div>
    <!--container-->
  </div>
  <!--account-wrap-->
  <br />
  <br />
@endsection
