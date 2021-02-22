<div class="checkout-container">
	<div class="container">
		<div class="basket-info">
			<h1>You Have <span class="basket-count flusher-checkout">3</span> items in your basket</h1>
		</div>
		<a  href="{{route('checkout')}}" class="btn btn-primary btn-lg checkout-btn">Checkout Now</a>
	</div>
</div>


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
<div class="fotter-logo">
	 <div class="container">
	 <div class="ftr-logo"><h3><a href="index.html"><img src="/images/white_logo.png" width="150px" alt=""></a></h3></div>
	 <div class="ftr-info">
	 
	</div>
	 <div class="clearfix"></div>
	 </div>
</div>


<script>
	var basket_items= localStorage.getItem('basket') ? JSON.parse(localStorage.getItem('basket')) : [] ;
	if( basket_items.length != 0){
		$('.basket-count').html(basket_items.length)
		$('.simpleCart_quantity').html( basket_items.length);
		$('.checkout-container').addClass('show');
	}
</script>