<script src="/js/jquery.min.js"></script>

	 <div class="container main-navbar">
	     <div class="main-header">
		 	  @if(auth()->check())
			  <div class="carting">
				 <ul><li><a href="#" onclick="document.getElementById('logout-form').submit()"> Logout</a></li></ul>
			  </div>
			  <form id="logout-form" action="{{route('logout')}}" method="post" style="display:none" >
				<input type="submit">
			  </form>	
			  @else
			  <div class="carting">
				 <ul><li><a href="{{route('loginPage')}}">Login</a></li></ul>
			  </div>
			  @endif
			 <div class="logo">
				 <h3><a href="{{route('home')}}"><img width="200px" src="/images/logo_2_1.png"/></a></h3>
			  </div>
		  
			 <div class="box_1">	
			 @if(!auth()->user() || (auth()->user() &&  !auth()->user()->isAdmin()))
				 <a href="{{route('checkout')}}"><h3>Basket:  (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)<img class="basket_icon_nav" src="/images/cart.png" alt=""/></h3></a>

			@endif
			 </div>			 
		 </div>
		<div class="clearfix"></div>			   	
	 </div>

