@extends('layouts.main')

@section('title', __('Home'))
@section('content')
<div class="header">
	<div class="caption">
		<h1>SOFTWARE & CARS</h1>	 
		<p>Take care of your car, your car is our priority. </p>
	</div>
</div>
<div class="features" id="features">

@php 
  $lang =  'eng'; 
@endphp 

	 <div class="container">
		 <div class="tabs-box market_gellary">
			
			 @foreach($products as $product)
					
					<div class="tab-grids ">
						<div id="tab1" class="tab-grid1">
									   				  
							<a href="{{route('product_view',['id' => $product->id])}}"><div class="product-grid">					  
									<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
										<img src="{{$product->file->path}}" class="img-responsive" alt=""/>
										<div class="b-wrapper">
										<h4 class="b-animate b-from-left  b-delay03">							
										<button class="btns">Shop now</button>
										</h4>
										</div>
									</div>
									<div class="image-caption">
										<h3><p>{{$lang == 'eng' ? $product->name : $product->name_ar}}</p> </h3>
										<span class="meta">{{$lang == 'eng' ? $product->desc : $product->desc_ar}}</span> </div>
									</div>
							</a>						
						</div>		
					</div>
				@endforeach
		 <!-- <div class="tab-grids ">
			 <div id="tab1" class="tab-grid1">			   				  
				<a href="{{route('product_view',['id'	=>2])}}"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-1.jpg" class="img-responsive" alt=""/>
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button class="btns">Shop now</button>
							</h4>
							</div>
						</div>
						 <div class="image-caption">
							<h3><p>Stationery Branding</p> </h3>
							<span class="meta">Identity, Branding</span> </div>
						</div>
				 </a>						
			</div>		
		</div>
 -->


</div>
</div>


@endsection
