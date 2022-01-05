@extends('layouts.app')
@section('style')
<style>
    h6{
    font-size: 18px;
    font-weight: 700;
    text-align:center;
    margin-bottom: 40px;
    margin-top: 40px;
    }
    .fade{

    opacity: 1 !important;

    }
    .tab-pane img{
    width: 100%;
    height: auto;
    text-align:center;
    margin-bottom: 50px;
    margin-top: 10px;
    }
    </style>
@endsection
@section('content')


<article class="inner-banner">
    <div class="page-heading">
      <h4>Wash Clean & Dry</h4>
    </div>
    <!--page-heading-->
    <img src="{{ asset('assets/images/insidebanner.jpg') }}" alt="inner banner" class="img-responsive" width="100%"/> </article>
  <!--inner-banner-->
  <div class="bcrumbs">
    <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li>Services</li>
      </ul>
    </div>
  </div>
  <div class="featured-products">
    <div class="container">
      <div class="row">
     <!---   <div id="isotope" class="isotope" style="position: relative; height: 906.376px;">
          </div>-->

  <div class="tab-content">
      <div class="tab-pane fade show active" id="home">
      <h5 class="heading"><span>PREP</span></h5>








@foreach ($packages as $package)
<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
    <div class="srvhead">
    <span class="neg">{{ $package->name }}</span></div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12"><img src="{{ asset('assets/images/bg/vipwash.jpg')}}" class="img-responsive" width="100%"></div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
    <p class="srvpara">VIP Wash combination of PH Wash using PH neutral shampoo using twin grit guard bucket system to prevent any stones and sharp edge particles being carried onto the car via the wash mitt. Snow foam is applied to lift any dirt and grit from the paintwork and adding a steam wash for excellent sterilizing and cleaning power, with Engine Cleaning using the Zero VOC biodegradable formula for cleaning all vehicle engines and surfaces under a hood. After the deep wash we will apply IGL wax  to helps preserve the clear coat over a vehicle's paint. <br><br>
    <b>For Interior</b><br><br>
Windows are cleaned on the inside. Interior trim and surfaces are all cleaned using aerospace – grade products</p>

        <a href="{{ route('checkout')}}" class="suv">SUV : 210</a>
        <a href="{{ route('checkout')}}" class="suv">SALOON : 189</a>
    <div class="pagebrk"></div></div></div>
@endforeach





      </div>





      </div>
      </div>
  </div>

        </div>
      </div>
    </div>
  </div>

@endsection
