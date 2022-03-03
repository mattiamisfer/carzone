@extends('layouts.app')
@section('content')

<div class="blog-content">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      
      <aside class="col-sm-6 col-md-6 col-md-offset-3 space70" style="text-align:center;">
	 
             <p> <img src="{{ asset('assets/images/error.png')}}" height="120px" width="120px"/></p>
			 <p> <a href="#" class="user">  Sorry Payment is Failed </a></p>
              
   			
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

@endsection

@section('payment-js')
<script >
    function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;
    
         document.body.innerHTML = printContents;
    
         window.print();
    
         document.body.innerHTML = originalContents;
    }
    </script>
@endsection