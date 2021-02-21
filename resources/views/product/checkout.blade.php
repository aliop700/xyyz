@extends('layouts.main')

@section('title', 'Index')
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

	<div id="paypal-button-container" style="text-align: center;"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AbiYw-cjDDsaJZPgD51Mz_9mSHNWj5OZC0YjjyJkDJ_1owqcrjo0go4XYREO5o4i0-nvDJE0jR6OIAmY&currency=USD"></script> -->
	<script src="https://www.paypal.com/sdk/js?client-id=AbiYw-cjDDsaJZPgD51Mz_9mSHNWj5OZC0YjjyJkDJ_1owqcrjo0go4XYREO5o4i0-nvDJE0jR6OIAmY"></script> <!-- test env-->

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
			createOrder: function(data,actions){
				return actions.order.create({
					purchase_units:[{
						amount:{
							value: 1.5
						}
					}]
				})
			},
			onApprove: function(data,actions){
				return actions.order.capture().then(function(details){
					window.location.replace('success_checkout.html')
				})
			},
			onCancel: function(data){
				window.location.replace('cancel_checkout.html')
			},

        }).render('#paypal-button-container');
    </script>
   </div>
</div>

</div>

<div class="clearfix"></div>
<script>
	function addOrder(){
		var products = [{product_id: 1 , quantity : 2 } , {product_id : 2 , quantity : 3}];
		var payload ={
			products: products,
			delivery_method:'DHL'
		}

		$.ajax({
               type: "POST",
               url: '/orders',
			   data: payload,
               success: function(res) 
                  {
                    alert('success')
                  },
                  error: function(){
                     alert('failure');
                  }
               });
	}
</script>
<!--fotter-->

@include('components.footer');

@endsection
