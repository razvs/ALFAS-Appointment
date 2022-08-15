$(document).ready(function () {



	$("#confirmbooking").on('click', function(){
		$("#firstc").remove();
		$("#form").load('frontend/booking_form.php');
	});

	$("#insertbooking").on('click', function(){
		
		var firstname = $("input[name=firstname]").val()
		var lastname = $("input[name=lastname]").val()
		var address = $("input[name=address]").val()
		var postcode = $("input[name=postcode]").val()
		var phone = $("input[name=phone]").val()
		var email = $("input[name=email]").val()
		var message = $("textarea[name=message]").val()
		var payby = $("input[name=payby]").val()

if(firstname == ""){
	$('#firstname_err').html("Please enter your first name");
}else{
	$('#firstname_err').html("");	
}

if(lastname == ""){
	$('#lastname_err').html("Please enter your last name");
}else{
	$('#lastname_err').html("");	
}

if(address == ""){
	$('#address_err').html("Please enter your address");
}else{
	$('#address_err').html("");	
}

if(postcode == ""){
	$('#postcode_err').html("Please enter your post code");
}else{
	$('#postcode_err').html("");	
}

if(phone == ""){
	$('#phone_err').html("Please enter your contact number");
}else{
	$('#phone_err').html("");	
}

if(email == ""){
	$('#email_err').html("Please enter your email address");
}else if(!validateEmail(email)){
	$('#email_err').html("Please enter a valid email address");
}else{
	$('#email_err').html("");	
}

 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

		  jQuery.ajax({
		   type: "POST",
		   url: "frontend/insert_booking.php",
		   data: 'firstname='+firstname + '&lastname='+lastname + '&address='+address + '&postcode='+postcode + '&phone='+phone + '&email='+email + '&message='+message + '&payby='+payby,
		   cache: false,
			success: function (data) {
				if (!$.trim(data)){   
					
				}
				else{   
					$("#secondc").remove();
					$("#form").load('frontend/thanks.php');					
				}					
			},

		 });
		 
	});

});
