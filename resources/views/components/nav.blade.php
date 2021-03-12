
	 <div class="container main-navbar">
	     <div class="main-header">

			 <div class="logo">
				 <h3><a href="{{route('home')}}"><img width="200px" src="/images/logo_2_1.png"/></a></h3>
			  </div>
		  
			 <div class="box_1">
			 <div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-bars"></i>
				</a>
				
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{auth()->user() &&  auth()->user()->isAdmin() ? route('admin') : route('home')}}"><i class="fa fa-home nav-item-icon"></i> {{ __('Home') }}</a>
						@if(auth()->check() && !auth()->user()->isAdmin())
							<a class="dropdown-item" href="{{route('myOrders')}}"><i class="fa fa-shopping-basket nav-item-icon"></i> {{ __('My Orders') }}</a>
						@endif
						
						@if(!auth()->check())
						<a class="dropdown-item" href="{{route('loginPage')}}"><i class="fa fa-sign-in nav-item-icon"></i> {{ __('Login') }}</a>
						<a class="dropdown-item" href="{{route('regPage')}}"><i class="fa fa-pencil-square-o nav-item-icon"></i> {{ __('Register') }}</a>
						@endif
						
						<a href="/setlocale/{{App::getLocale() == 'en' ? 'ar' : 'en'  }}" class="dropdown-item"><i class="fa fa-language nav-item-icon"></i> {{App::getLocale() == 'en' ? 'عربي'  : 'English'}}</a>
						
						@if(auth()->check())
							<a href="#" class="dropdown-item" onclick="document.getElementById('logout-form').submit()"><i class="fa fa-sign-out nav-item-icon"></i> {{ __('Logout') }}</a>
						@endif

				</div>
				<form id="logout-form" action="{{route('logout')}}" method="post" style="display:none" >
							<input type="submit">
				</form>	
			 </div>	
			 @if(!auth()->user() || (auth()->user() &&  !auth()->user()->isAdmin()))
				 <a class="nav-checkout-btn" href="{{route('checkout')}}"><h3>{{ __('Basket')}}:  (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> {{ __('items')}})<img class="basket_icon_nav" src="/images/cart.png" alt=""/></h3></a>

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