
<!DOCTYPE html>
<html>
<head>
<title>Cars</title>
<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />	

<script src="{{asset('/js/jquery.min.js')}}"></script>
<script src="{{asset('/js/main.js')}}"></script>

</head>

   
<body>


<!--header-->

<div class="login-page">
<div class="header_login text-center">
	 <div class="container">
		 <div class="main-header">
			  <div class="carting">
				 <ul><li><a href="{{route('home')}}">Home</a></li></ul>
				 </div>
			 <div class="logo">
				 <h3><a href="{{route('home')}}">CARS</a></h3>
			  </div>			  
			  <div class="clearfix"></div>
	
		</div>
	 </div>
  </div>
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
<div class="login">
	 <div class="container">
		 
		
		 <div class="log login-register-box">			 
				<h2>Login</h2>
				 <form name="login_form" method="post" action="{{route('loginPost')}}" id="login_form">
					 @csrf
					 <h5>User Name:</h5>	
					 <input type="text" name="email">
					 <h5>Password:</h5>
					 <input type="password"  name="password">					
					 <input type="submit" value="Login" id="login_btn">
					  <a class="register-link" href="{{route('regPage')}}"><h4>Register</h4></a>
				 </form>				 
		 </div>
		 <div class="clearfix"></div>		 
		 
	 </div>
</div>

</body>
</html>
		