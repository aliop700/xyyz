@extends('layouts.main')

@section('title', __('Checkout'))
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
   <div style="margin-top: 60px; max-width:750px; margin: 0 auto; float:none;">
		@if ($message = Session::get('success'))
		<div class="custom-alerts alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			{!! $message !!}
		</div>
		<div class="success_payment_message"></div>
		<script>localStorage.removeItem('basket');</script>
		<?php Session::forget('success');?>
		@endif

		@if ($message = Session::get('error'))
		<div class="custom-alerts alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			{!! $message !!}
		</div>
		<?php Session::forget('error');?>
		@endif
	</div>
	<div class="checkout-view hidden">
		<div class="products-list"> 
			<table class="table table-striped table-bordered products-list-table">
				<thead>
					<th>{{ __('Product Name')}}</th>
					<th>{{ __('Price')}}</th>
					<th>{{ __('Quantity')}}</th>
					<th></th>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>
		</div>
		<div class="delivery_method_box">
		<form  method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
				{{ csrf_field() }}
				<input id="amount" type="text" class="form-control hidden" name="amount" value="" autofocus>
				<input id="items_list" type="text" class="form-control hidden" name="items_list" value="" autofocus>
				<div class="form-group">
				<label>{{ __('Delivery Method') }}</label>
				<select name="delivery_method" required id="delivery_method_input" class="form-control" >
					<option>DHL</option>
					<option>Aramex</option>
				</select>
				</div>
				<div class="form-group">
					<label>{{ __('Location') }}</label>
					<input type="text" class="form-control" required id="location_input" name="location" placeholder="{{ __('Country')}} - {{ __('City')}} - {{ __('Street')}}" value="{{auth()->check() ? (auth()->user()->country  .'-'. auth()->user()->city .'-'. auth()->user()->street) : ''}}"/>
				</div>
				<div class="form-group">
					<label>{{ __('Mobile Number') }}</label>
					<input type="phone" class="form-control" required id="phone_input" name="phone" placeholder="example: +9627***" value="{{auth()->check() ? auth()->user()->phone  : ''}}"/>
				</div>
				<div class="form-group">
					<label>{{ __('Email') }}</label>
					<input type="phone" class="form-control" required id="email_input" name="email" placeholder="example: test@test.com" value="{{auth()->check() ? auth()->user()->email  : ''}}"/>
				</div>
				<div class="form-group hidden">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							Paywith Paypal
						</button>
					</div>
				</div>
			</form>
			
		</div>
		<div class="paypal_container_box">
			@if(!auth()->check())
				<a class="auth_mask" onclick="askToLogin()"></a>
			@endif
			<div id="checkout-button">
	  			<button class="btn btn-primary btn-lg" id="pay_with_paypal_button" onclick="payWithPaypal()"> {{__('Pay with')}} PayPal <i class="fa fa-paypal" aria-hidden="true"></i></button>
			</div>
			<!-- <div id="paypal-button-container" style="text-align: center;"></div> -->
		</div>
	</div>
	<div class="no-data-to-checkout hidden" style="text-align:center;">
	<i class="fa fa-frown-o danger" aria-hidden="true" style="font-size: 20vh; margin-bottom:20px;"></i>
		<h2>{{ __('You did not select any product')}}</h2>
	</div>
</div>
</div>

</div>

<div class="clearfix"></div>

@include('payment.checkout_js');


@endsection
