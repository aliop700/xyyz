@extends('layouts.main')

@section('title', 'Checkout')
@section('content')

<style>
	.checkout-container {
		display:none !important;
	  }
</style>
<!--header-->
<div class="header2 text-center"></div>
<!--header//-->


<div class="container-fluid" id="product-page">
<div class="container product-detail-top">
   <div class="row">
	<!-- This code uses the client side JavaScript PayPal SDK -->
	<div class="checkout-view hidden">
		<div class="products-list"> 
			<table class="table table-striped table-bordered products-list-table">
				<thead>
					<th>Product Name</th>
					<th>Price</th>
					<th>quantity</th>
					<th></th>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="delivery_method_box">
			<div class="form-group">
				<label>Delivery Method</label>
				<select name="delivery_method" id="delivery_method_input" class="form-control" >
					<option>DHL</option>
					<option>Aramex</option>
				</select>
			</div>
			<div class="form-group">
				<label>Location</label>
				<input type="text" class="form-control" id="location_input" name="location" placeholder="Country - City - Street" value="{{auth()->check() ? (auth()->user()->country  .'-'. auth()->user()->city .'-'. auth()->user()->street) : ''}}"/>
			</div>
			<div class="form-group">
				<label>Phone Number</label>
				<input type="phone" class="form-control" id="phone_input" name="phone_number" placeholder="example: +9627***" value="{{auth()->check() ? auth()->user()->phone  : ''}}"/>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="phone" class="form-control" id="email_input" name="email_input" placeholder="example: test@test.com" value="{{auth()->check() ? auth()->user()->email  : ''}}"/>
			</div>
		</div>
		<div class="paypal_container_box">
			@if(!auth()->check())
				<a class="auth_mask" onclick="askToLogin()"></a>
			@endif
			<div id="paypal-button-container" style="text-align: center;"></div>
		</div>
	</div>
	<div class="no-data-to-checkout hidden" style="text-align:center;">
	<i class="fa fa-frown-o danger" aria-hidden="true" style="font-size: 20vh; margin-bottom:20px;"></i>
		<h2>You did not select any product</h2>
	</div>

    <!-- Include the PayPal JavaScript SDK -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AbiYw-cjDDsaJZPgD51Mz_9mSHNWj5OZC0YjjyJkDJ_1owqcrjo0go4XYREO5o4i0-nvDJE0jR6OIAmY&currency=USD"></script> -->
</div>
</div>

</div>

<div class="clearfix"></div>
<script src="/js/sweet-alert.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AbiYw-cjDDsaJZPgD51Mz_9mSHNWj5OZC0YjjyJkDJ_1owqcrjo0go4XYREO5o4i0-nvDJE0jR6OIAmY&disable-funding=credit,card"></script> <!-- test env-->
<script>
	var products_in_basket = localStorage.getItem('basket') != null ? JSON.parse(localStorage.getItem('basket')) : [];

	function addOrder(paypalResp){
		var products = products_in_basket.map(function(item){
			return {product_id: item.product_id , quantity : item.quantity}
		})
		var payload ={
			products: products,
			delievery_method:$('#delivery_method_input').val(),
			phone:$('#phone_input').val(),
			location:$('#location_input').val(),
			email:$('#email_input').val(),
			paypal_response: paypalResp
		}

		$.ajax({
               type: "POST",
               url: '/orders',
			   data: payload,
               success: function(res) 
                  {
                    // alert('success')
                  },
                  error: function(){
					 swal("Oops!", "Something wrong, contact with us at info@autorepairskit.com", "error");
                  }
               });
	}
	
	function cleanBasket(){
		localStorage.removeItem('basket');
	}
	
	function removeProduct(product_id){
		var product = products_in_basket.filter(function(item){
			return item.product_id == product_id;
		})[0];

		products_in_basket.splice(product, 1);
		localStorage.setItem('basket', JSON.stringify(products_in_basket))

		drawProducts();

	}
	
	function drawProducts(){
		$('.products-list-table tbody').empty();
		if(products_in_basket.length){
			
			$('.checkout-view').removeClass('hidden');
			products_in_basket.forEach(function(item){
					$('.products-list-table tbody').append(
					'<tr id="'+item.product_id+'" >'+
					'<td>'+item.product_name+'</td>'+
					'<td>'+item.product_price+'</td>'+
					'<td>'+item.quantity+'</td>'+
					'<td><button onclick="removeProduct('+item.product_id+')" class="danger btn">Remove &nbsp;<i class="fa fa-remove danger"></i> </button></td>'
				)
			})
		}else{
			$('.no-data-to-checkout').removeClass('hidden');
			$('.checkout-view').addClass('hidden');
	 	    $('.basket_icon_nav').removeClass('flusher-checkout');
			 $('.simpleCart_quantity').html(0)
		}
		

	}
	getDebugger()
	function getDebugger(){
	setTimeout(function() {
			debugger;	
			getDebugger()
		}, 100);
	}
	$(document).ready(function(){
		drawProducts();
		
		
	})
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
			createOrder: function(data,actions){
				var prices_arr = products_in_basket.map(function(item) {
					return Number(item.product_price) * Number(item.quantity)
				})
				var amount_ = prices_arr.length ? prices_arr.reduce(function(total, amount) {
					return total + amount;
				}) : 0;
				return actions.order.create({
					purchase_units:[{
						amount:{
							value: amount_
						}
					}]
				})
			},
			onApprove: function(data,actions){
				return actions.order.capture().then(function(details){
					// window.location.replace('success_checkout.html')
					var paypalRes = JSON.stringify(details);
					addOrder(paypalRes);
					cleanBasket();
					swal("Successfully", {
						icon:'success',
						text: "You will receive an email with the details",
						buttons: {
							cancel: false,
							catch: {
							text: "Ok",
							value: true,
							},
						},
					})
					.then(function(value) {
						if(value)
						window.location.replace('/')
					});
				})
			},
			onCancel: function(data){
				swal("Oops!", "Something wrong, Please try again", "error");
			},

        }).render('#paypal-button-container');

		function askToLogin(){
			// swal("Oops!", "Something wrong, Please try again", "error");
			swal("Info", {
						icon:'warning',
						title:'You are not logged in!',
						text: "If you do not have an account, create an account in one minute!",
						buttons: {
							cancel: false,
							catch: {
								text: "Login",
								value: 'login',
							},
							defeat:  {
								text: "Register",
								value: 'register',
							},
						},
			})
			.then(function(value) {
				if(value == 'login'){
					window.location.replace('/login?checkout:true');
				}else if(value == 'register'){
					window.location.replace('/register?checkout:true');

				}
			});
		}
    </script>
@endsection
