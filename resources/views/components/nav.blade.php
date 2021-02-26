<script src="/js/jquery.min.js"></script>

	 <div class="container main-navbar">
	     <div class="main-header">
		 	  

			  <div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-bars"></i>
				</a>
				<!-- @if(!auth()->check())
					<a class="carting" href="{{route('loginPage')}}">Login</a>
				@endif -->
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('home')}}">Home</a>

					@if(auth()->check())
						<a href="#" onclick="document.getElementById('logout-form').submit()"> Logout</a>
						<form id="logout-form" action="{{route('logout')}}" method="post" style="display:none" >
							<input type="submit">
						</form>	
					@else
						<a class="dropdown-item" href="{{route('loginPage')}}">Login</a>
					@endif
				</div>
			 </div>
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

	 <script>
		$('.nav-link').on('click',function(){
			$('nav .dropdown-menu').toggle('show')
		})
	</script>