@extends('layouts.main')

@section('title', 'Index')
@section('content')
<!--header-->
<div class="header2 text-center">
	
</div>
<!--header//-->
<form class="custom" onsubmit="return false" method="post" action="/product/square-it">
		<div class="container-fluid" id="product-page">
		<div class="container product-detail-top">
   <div class="row">
      
<div class="col-md-7 slider_parrent">
	<img src="/images/product-6.jpg">
</div>
<!-- {{$product}} -->
      <div class="col-md-5 row product-detail">
<!-- ============================= Product name and price -->      
        <div class="col-md-12">
          <h1>{{$product->name}}
         	 <span> {{$product->price}}$ </span>
          </h1>
          <h2>{{$product->car_name}}</h2>
          <hr>
          <p></p><p>{{$product->desc}}.</p><p></p>
        </div>
<!-- ============================= Product Quantity -->
 
        
      <div class="attribute-group">   
              <div class="product-options col-md-6">
      <p class="title" for="quantity">QUANTITY</p>
      <span>
         <input name="quantity" class="form-control" type="number" value="1"/>
      </span>
    </div>
  
      </div>
      <div class="attribute-group">
        
      </div>
      <div class="attribute-group">
        
      </div>

        <div class="col-md-12 attribute-group">
          <a  class="item_add" href="{{route('checkout')}}"> Add
            </a>
        </div>

     
      
        <div class="to-cart-flash col-md-12">
          <p class="custome-msg" style="font-size:0;visibility:hidden;"> successful add </p>
          
        </div>   
      </div>
   </div>
</div>

	</div>
	</form>
		 <div class="clearfix"></div>

<!--fotter-->

@include('components.footer');

@endsection
