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
                <div class="success_payment_message">
                   <img src="/images/order_confirmed.svg" class="order_success" alt="Success"/>
                   <h1>{{ __('Successfully') }}</h1>
                    <h4>{{ __('You will receive an email with the details') }}</h4>
                    <a href="{{route('home')}}" class="btn btn-lg btn-primary"><i class="fa fa-home"></i>{{__('Go To Home')}}</a>
                </div>
                <script>localStorage.removeItem('basket');</script>
                <?php Session::forget('success');?>

                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
            </div>
        </div>
  </div>
</div>

<div class="clearfix"></div>
<script src="/js/sweet-alert.min.js"></script>

@include('payment.checkout_js');


@endsection
