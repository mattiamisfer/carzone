@extends('layouts.app')
@section('title','Services || '.$name->name)
@section('style')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> 
<script>
  $(document).ready(function(){

      $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
          var activeTab = $(e.target).text(); // Get the name of active tab
          var previousTab = $(e.relatedTarget).text(); // Get the name of previous tab
          $(".active-tab span").html(activeTab);
          $(".previous-tab span").html(previousTab);
      });
  });
</script>
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
    <h4>{{$name->name }}</h4>
  </div>
  <!--page-heading-->
  <img src="{{ asset('assets/images/insidebanner.jpg')}}" alt="inner banner" class="img-responsive" width="100%"/> </article>
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
    @foreach ($packages as $currentpackage )
    <div class="row">
   <!---   <div id="isotope" class="isotope" style="position: relative; height: 906.376px;">
        </div>-->
		<ul class="nav nav-tabs">
    {{-- <li class="nav-item">
        <a href="#home" class="nav-link active" data-toggle="tab"><span class="negtab">EXTERIOR
</a>
    </li>
    <li class="nav-item">
        <a href="#messages" class="nav-link" data-toggle="tab">INTERIOR
</a>
    </li> --}}
    @foreach ($currentpackage->subcategory as $key =>  $item)
          
      
    <li class="nav-item">
        <a href="#home_{{$key}}" class="nav-link  {{ $key === 0 ? "active" : "fade" }}" data-toggle="tab"><span class="negtab"> {{$item->name}}
</span></a>
    </li>

    
    @endforeach
</ul>
<div class="tab-content">  	

  @if($currentpackage->subcategory->count() == 0)
     <div class="tab-pane fade show active" id="home">
	<h5 class="heading"><span>PRO </span></h5>
  @foreach ($currentpackage->packagecat as $package)
 
	<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
    @if ($package->name =='video')
    @else
    <div class="srvhead">

  
      <span class="neg">{{ $package->name }}</span></div>
  @endif

    @if (pathinfo($package->image, PATHINFO_EXTENSION) == 'jpeg' ||
    pathinfo($package->image, PATHINFO_EXTENSION) == 'jpg' ||
    pathinfo($package->image, PATHINFO_EXTENSION) == 'png')
    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12"><img src="{{Storage::disk('s3')->url('images/'.$package->image)}}" class="img-responsive" width="100%"></div>

    @else

    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
      <video controls="" style="max-width: 100%; height: auto; " width="1080">
        <source src="{{Storage::disk('s3')->url('video/'.$package->image)}}" type="video/mp4">
        </video>
    @endif

   

     <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
      
      {!!$package->content!!}
      
     @foreach ($package->price as $item)
     <a href="{{ route('checkout',['id' => $package->id,'type' => $item->id])}}" class="suv">{{ $item->name }} : {{ floatval($item->price) }} </a>

     @endforeach
	<div class="pagebrk"></div></div></div>
  @endforeach

   
 
	<!---<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
		  <video controls="" style="max-width: 100%; height: auto; " width="1080">
			<source src="images/videos/polish.mp4" type="video/mp4">
			</video>
		 </div>--->
 
 
	 
 
	
	   
	</div>

  @else
  @foreach ($currentpackage->subcategory as $key => $item)
  <div class="tab-pane  fade .... {{ $key === 0 ? "show active" : "fade" }}" id="home_{{$key}}">
    <h5 class="heading"><span>{{ $item->name}} </span></h5>
    @foreach ($item->package as $package)
      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
        @if ($package->name =='video')
        {{-- {{$package->id}} --}}
        @else
       
        <div class="srvhead">
    
      
          <span class="neg">{{ $package->name }}</span></div>
      @endif

  @if (pathinfo($package->image, PATHINFO_EXTENSION) == 'jpeg' ||
   pathinfo($package->image, PATHINFO_EXTENSION) == 'jpg' ||
   pathinfo($package->image, PATHINFO_EXTENSION) == 'png')
    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12"><img src="{{Storage::disk('s3')->url('images/'.$package->image)}}" class="img-responsive" width="100%"></div>

    @else

    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
      <video controls="" style="max-width: 100%; height: auto; " width="1080">
        <source src="{{Storage::disk('s3')->url('video/'.$package->image)}}" type="video/mp4">
        </video>
    </div>
    @endif
 
	<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
	
    
      {!!$package->content !!}
 	
   @foreach ($package->price as $item)
   <a href="{{ route('checkout',['id' => $package->id,'type' => $item->id])}}" class="suv">{{ $item->name }} : {{ floatval($item->price) }} </a>

   @endforeach
	<div class="pagebrk"></div></div></div>
  @endforeach
 
	
	</div>

  @endforeach

  @endif
	</div>
</div>

@endforeach  
{{-- row --}}
        
      </div>
    </div>
  </div>
</div>

<!---contents-section--->
<!-- FOOTER -->
 
<!-- FOOTER COPYRIGHT -->
 
</div>


@endsection  
