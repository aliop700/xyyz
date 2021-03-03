paywithpaypal page
{{Session::get('paypal_payment_id')}}

@if(!empty(Session::get('error'))) {{ Session::get('error')}} @endif
@if(!empty(Session::get('success'))) {{ Session::get('success')}} @endif