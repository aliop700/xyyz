@extends('layouts.main')

@section('title', 'Index')
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
<!-- @foreach($products as $product)
				{{$product}}
			@endforeach -->
	 <div class="container">
		 <div class="tabs-box market_gellary">
			
			 @foreach($products as $product)
					
					<div class="tab-grids ">
						<div id="tab1" class="tab-grid1">			   				  
							<a href="{{route('product_view')}}"><div class="product-grid">					  
									<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
										<img src="images/product-{{$product->id}}.jpg" class="img-responsive" alt=""/>
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
				 <a href="{{route('product_view')}}"><div class="product-grid">					  
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
		 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-2.jpg" class="img-responsive" alt=""/>
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
 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-3.jpg" class="img-responsive" alt=""/>
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
 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-4.jpg" class="img-responsive" alt=""/>
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
 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-5.jpg" class="img-responsive" alt=""/>
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
 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
						<div class="product-img b-link-stripe-market b-animate-go  thickbox">						   
							<img src="images/product-6.jpg" class="img-responsive" alt=""/>
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
		</div> -->


</div>
</div>


@include('components.footer');

@endsection
