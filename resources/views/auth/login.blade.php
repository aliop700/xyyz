@extends('layouts.main')

@section('title', __('Login') )
@section('content')

<div class="login-page">


<div class="login">
	 <div class="container">
	 @if($errors->any())
  <div class="container">
	<div class="alert alert-warning">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
		</ul>
	</div>
	</div>
	@endif
		
		 <div class="log login-register-box">			 
				<h2>{{ __('Login')}}</h2>
				 <form name="login_form" method="post" action="{{route('loginPost')}}" id="login_form">
					 @csrf
					 <h5>{{ __('Email')}}:</h5>	
					 <input type="text" name="email">
					 <h5>{{ __('Password')}}:</h5>
					 <input type="password"  name="password">					
					 <input type="submit" value="{{ __('Login')}}" id="login_btn">
					  <a class="register-link" href="{{route('regPage')}}"><h4>{{ __('Register')}}</h4></a>
				 </form>				 
		 </div>
		 <div class="clearfix"></div>		 
		 
	 </div>
</div>

</body>
</html>
		