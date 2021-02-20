@extends('layouts.main')

@section('title', 'Index')
@section('content')


<div class="login-page">
 
<div class="login">
	 <div class="container">
		  <div class="login-register-box  login-right">
		  <form name="Register_form" method="post" id="Register_form" action="{{route('regPost')}}">
            @csrf   
          <div class=" reg-form">
			 <div class="reg">
	        	 <h2>Register</h2>

					 <ul>
						 <li class="text-info">First Name: </li>
						 <li><input required type="text" name="firstName" ></li>
					 </ul>
					 <ul>
						 <li class="text-info">Last Name: </li>
						 <li><input required type="text"   name="lastName"></li>
					 </ul>				 
					<ul>
						 <li class="text-info">Email: </li>
						 <li><input required type="text" name="email"></li>
					 </ul>
					 <ul>
						 <li class="text-info">Password: </li>
						 <li><input required type="password" name="password"></li>
					 </ul>
					 <ul>
						 <li class="text-info">Confirm Password:</li>
						 <li>
						 	<input required type="password" name="confirmPassword">
							 <span class="danger error hidden  confirmPassError"> confirm password not matching with password</span>
						 </li>
					 </ul>
					 <ul>
						 <li class="text-info">Mobile Number:</li>
						 <li><input required type="text" name="mobileNumber"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">Country:</li>
						 <li><input required type="text" name="country"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">City:</li>
						 <li><input required type="text" name="city"></li>
					 </ul>	
 					 <ul>
						 <li class="text-info">Street:</li>
						 <li><input required type="text" name="street"></li>
					 </ul>						
					 <input type="submit" class="Register-btn" id="submit_reg"> 
				
			 </div>
		 </div>
		 </form>
		 </div>
		 <div class="clearfix"></div>		 
		 
	 </div>
</div>

</body>
</html>
		