@extends('layouts.main')

@section('title', __('Register'))
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
		  <div class="login-register-box  login-right">
		  <form name="Register_form" method="post" id="Register_form" action="{{route('regPost')}}">
            @csrf   
          <div class=" reg-form">
			 <div class="reg">
	        	 <h2>Register</h2>

					 <ul>
						 <li class="text-info">{{ __('Name')}}: </li>
						 <li><input required type="text" name="name" ></li>
					 </ul>		 
					<ul>
						 <li class="text-info">{{ __('Email')}}: </li>
						 <li><input required type="text" name="email"></li>
					 </ul>
					 <ul>
						 <li class="text-info">{{ __('Password')}}: </li>
						 <li><input required type="password" name="password"></li>
					 </ul>
					 <ul>
						 <li class="text-info">{{ __('Confirm Password')}}:</li>
						 <li>
						 	<input required type="password" name="password_confirmation">
							 <span class="danger error hidden  confirmPassError"> {{ __('confirm password not matching with password')}}</span>
						 </li>
					 </ul>
					 <ul>
						 <li class="text-info">{{ __('Mobile Number')}}:</li>
						 <li><input required type="text" name="phone"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">{{ __('Country')}}:</li>
						 <li><input required type="text" name="country"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">{{ __('City')}}:</li>
						 <li><input required type="text" name="city"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">{{ __('Street')}}:</li>
						 <li><input required type="text" name="street"></li>
					 </ul>						
					 <input type="submit" value="{{ __('Register')}}" class="Register-btn" id="submit_reg"> 
				
			 </div>
		 </div>
		 </form>
		 </div>
		 <div class="clearfix"></div>		 
		 
	 </div>
</div>

</body>
</html>
		