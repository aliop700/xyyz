// Attach a submit handler to the form
$(window).load(function() {
    $("#Register_form").submit(function() {
        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        var $form = $("#Register_form"),
            val_firstName = $form.find("input[name='firstName']").val(),
            val_lastName = $form.find("input[name='lastName']").val(),
            val_email = $form.find("input[name='email']").val(),
            val_password = $form.find("input[name='password']").val(),
            val_confirmPassword = $form
                .find("input[name='confirmPassword']")
                .val(),
            val_mobileNumber = $form.find("input[name='mobileNumber']").val(),
            // var singleValues = $( "#single" ).val();
            val_country = $("#country").val() || [],
            val_city = $form.find("input[name='city']").val(),
            val_street = $form.find("input[name='street']").val(),
            url = $form.attr("action");

        // Send the data using post
        /* var posting = $.post( "http://swiftytime.com/Api/controller/SignUpControl.php", {  firstName: val_firstName, lastName: val_lastName , email: val_email, password:val_password,confirmPassword:val_confirmPassword,mobileNumber: val_mobileNumber,country: val_country, city: val_city,street: val_street} );*/
        // $.ajax({
        //     type: "POST",
        //     url: " http://swiftytime.com/Api/controller/SignUpControl.php",
        //     data: {
        //         firstName: val_firstName,
        //         lastName: val_lastName,
        //         email: val_email,
        //         password: val_password,
        //         confirmPassword: val_confirmPassword,
        //         mobileNumber: val_mobileNumber,
        //         country: val_country,
        //         city: val_city,
        //         street: val_street
        //     },
        //     success: function(text) {
        //         alert("success");
        //         var response = "";
        //         response = text.responseText;

        //         alert(response);
        //     },
        //     error: function() {}
        // });

        //var msg = $.ajax({type: "GET", url: "http://swiftytime.com/Api/controller/SignUpControl.php", async: false}).responseText;
        //console.log(msg);
        //	});
    });

    // 	$( "#login_btn" ).click(function( event ) {
    // 		var $form = $( "#login_form" ),
    // 		val_email = $form.find( "input[name='email']" ).val(),
    // 		val_password = $form.find( "input[name='password']" ).val();
    // 		$.ajax({
    // 		type: "POST",
    // 		url: 'http://swiftytime.com/Api/controller/LoginControl.php',
    // 		data: {  email: val_email, password: val_password},
    // 		success: function() {
    // 		alert("success");
    // 		},
    // 		error: function(){
    // 		alert('failure');
    // 		}
    // 	});
    // });
});

$(function() {
    $(".subnavbar")
        .find("li")
        .each(function(i) {
            var mod = i % 3;

            if (mod === 2) {
                $(this).addClass("subnavbar-open-right");
            }
        });
});
