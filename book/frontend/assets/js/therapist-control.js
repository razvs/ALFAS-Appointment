
$(document).ready(function () {
	
	$(".therapist").on('click', function(){

if(type != "Single"){

	 if (jQuery(this).hasClass('active')) {

	   $(this).removeClass('active');
		  if($(this).find("span").data("id") == therapistid){
			  therapistid = "";
			  therapistname = "";
		  }else if($(this).find("span").data("id") == therapistid2){
			  therapistid2 = "";
			  therapistname2 = "";
		  }
	  }
	  else if(numItems<= 1)
	  {
		  $(this).addClass("active");
		  if(numItems == 0){			  
			  therapistid = $(this).find("span").data("id");
			  therapistname = $(this).find("span").data("name");
		  }else if(numItems == 1){
			  if(therapistid2 == 0){
				therapistid2 = $(this).find("span").data("id");
				therapistname2 = $(this).find("span").data("name");			  
			  }else{
				therapistid = $(this).find("span").data("id");
				therapistname = $(this).find("span").data("name");			  
			  }

		  }
			
	  }
  
	numItems = $('.therapist.active').length;
	if(therapistid != "" && therapistid2 != ""){
		$('#therapist-warning').html("");		
	}else if(therapistid == "" && therapistid2 == ""){
		$('#therapist-warning').html("");
	}else{
		$('#therapist-warning').html("you have to select two therapist");
	}
		$("#confirmbutton").load('frontend/confirm_booking.php?date='+day+'&time='+time+'&service='+serviceid+'&duration='+durationid+'&therapist='+therapistid+'&therapist2='+therapistid2+'&type='+type);
		$('#selected-service').html("You selected the following:"+servicename+" on "+day+" at "+time+" "+type+" booking for "+duration+" minutes with "+therapistname+" and "+therapistname2+".");		
	
}else{

 	therapistid = $(this).find("span").data("id");
	therapistname = $(this).find("span").data("name");
	
		$(".therapist").removeClass("active");
		$(this).addClass("active");

		$("#confirmbutton").load('frontend/confirm_booking.php?date='+day+'&time='+time+'&service='+serviceid+'&duration='+durationid+'&therapist='+therapistid+'&type='+type);
		$('#selected-service').html("You selected the following:"+servicename+" on "+day+" at "+time+" "+type+" booking for "+duration+" minutes with "+therapistname+".");		
}

});

});

			

