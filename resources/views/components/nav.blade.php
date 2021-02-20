
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
				 <ul><li><a href="{{route('loginPage')}}"> Login</a></li></ul>
			  </div>
			  @endif;
			 <div class="logo">
				 <h3><a href="{{route('home')}}"><img width="200px" src="images/logo.png"/></a></h3>
			  </div>
		  
			 <div class="box_1">				 
				 <a href="#"><h3>Basket:  (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> الاصناف)<img src="images/cart.png" alt=""/></h3></a>
				 <p><a href="javascript:;" class="simpleCart_empty"> empty basket</a></p>
			 </div>			 
		 </div>
		<div class="clearfix"></div>			   	
	 </div>
