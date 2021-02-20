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
	 <div class="container">
		 <div class="tabs-box market_gellary">
			
		 <div class="tab-grids ">
			 <div id="tab1" class="tab-grid1">			   				  
				 <a href="details_product.html"><div class="product-grid">					  
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
		</div>


</div>
</div>


<!--fotter-->
<div class="fotter">
	 <div class="container">
	 <div class="col-md-6 contact">
		  <form>
			 <input type="text" class="text" value="Name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name...';}">
			 <input type="text" class="text" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}">
			 <textarea onfocus="if(this.value == 'Message...') this.value='';" onblur="if(this.value == '') this.value='Message...';" >Message...</textarea>	
			 <div class="clearfix"></div>
			 <input type="submit" value="SUBMIT">
		 </form>

	 </div>
	 <div class="col-md-6 ftr-left">
		 <div class="ftr-list">
			 <ul>
				 <li><a href="{{route('home')}}">Home</a></li>
				 <li><a href="about.html">About</a></li>
				 <li><a href="{{route('loginPage')}}">Login</a></li>
				 
			 </ul>
		 </div>
	
		 <div class="clearfix"></div>
		 <h4>FOLLOW US</h4>
		 <div class="social-icons">
		 <a href="#"><span class="in"> </span></a>
		 <a href="#"><span class="you"> </span></a>
		 <a href="#"><span class="twt"> </span></a>
		 <a href="#"><span class="fb"> </span></a>
		 </div>
	 </div>	 
	 <div class="clearfix"></div>
	 </div>
</div>
<!--fotter//-->
<!-- <div class="fotter-logo">
	 <div class="container">
	 <div class="ftr-logo"><h3><a href="index.html"><img src="images/white_logo.png" width="150px" alt=""></a></h3></div>
	 <div class="ftr-info">
	 
	</div>
	 <div class="clearfix"></div>
	 </div>
</div> -->
@include('components.footer')

@endsection
