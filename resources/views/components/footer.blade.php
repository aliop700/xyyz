<div class="checkout-container">
	<div class="container">
		<div class="basket-info">
			<h1>{{ __('You Have')}} <span class="basket-count flusher-checkout"></span> {{ __('items in your basket')}}</h1>
		</div>
		<a  href="{{route('checkout')}}" class="btn btn-primary btn-lg checkout-btn">{{ __('Checkout Now')}}</a>
	</div>
</div>


<div class="fotter">
	 <div class="container">
	 <div class="col-md-6 contact">
		 <form id="contactUsForm" name="contactUsForm">
			 <input name="name" type="text" required class="text" placeholder="{{__('Name')}}...">
			 <input name="email" type="email" required class="text" placeholder="{{__('Email')}}...">
			 <textarea name="message" required onfocus="if(this.value == '{{__("Message")}}...') this.value='';" onblur="if(this.value == '') this.value='{{__("Message")}}...';">{{__('Message')}}...</textarea>	
			 <div class="clearfix"></div>
			 <input type="submit"  value="{{__('Submit')}}">
		 </form>

	 </div>
	 <div class="col-md-6 ftr-left">
		 <div class="ftr-list">
			 <ul>
				 <li><a href="{{route('home')}}">{{ __('Home')}}</a></li>
				 <li><a href="{{route('loginPage')}}">{{ __('Login')}}</a></li>
				 <li><a href="{{route('regPage')}}">{{ __('Register')}}</a></li>
				 
			 </ul>
		 </div>
	
		 <div class="clearfix"></div>
		 <h4>{{ __('FOLLOW US')}}</h4>
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
	 <div class="ftr-logo"><h3><a href="{{route('home')}}"><img src="/images/white_logo_2.png" width="150px" alt=""></a></h3></div>
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
		$('.basket_icon_nav').addClass('flusher-checkout');
	}

	$('#contactUsForm').on('submit',function(e){
    	e.preventDefault();
		var payload ={};
		$('#contactUsForm input:not([type="submit"]), #contactUsForm textarea').each(function(){
			payload[$(this).attr('name')] = $(this).val();
		})
		$.ajax({
			type: "post",
			url: '/contacts',
			data: payload,
			success: function(res) {
				if(res.success){
					swal({
						title: '{{__("Successfully") }}',
						icon:'success',
						buttons: {
							cancel: false,
							catch: {
							text: "{{ __('Ok') }}",
							value: true,
							},
						},
					});
				}
			}
			
		})
	})
</script>