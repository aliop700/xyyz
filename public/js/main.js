// Attach a submit handler to the form
$(window).load(function(){
	// $( "#Register_form" ).submit(function(event) {
	// 	$('.confirmPassError').addClass('hidden');

	//   // Stop form from submitting normally
		 
	// 	  // Get some values from elements on the page:
	// 	  var $form = $( "#Register_form" ),
	// 		val_email = $form.find( "input[name='email']" ).val(),
	// 		password = $form.find( "input[name='password']" ).val(),
	// 		confirmPassword = $form.find( "input[name='confirmPassword']" ).val();
	// 		if(password != confirmPassword){
	// 			event.preventDefault();
	// 			$('.confirmPassError').removeClass('hidden');
	// 			// alert('confirm password not matching with password')
	// 		}  
		
		 

	// });
});



$(function () {
	
	
	$('.subnavbar').find ('li').each (function (i) {
	
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
		
	});
	
	
	
});
