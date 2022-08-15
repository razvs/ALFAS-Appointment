$(document).ready(function () {

	$(".times").on('click', function(){
	time = $(this).find("span").data("time");
		$(".times").removeClass("active");
		$(this).addClass("active");
			therapistid = "";
			therapistname = "";
			therapistid2 = "";
			therapistname2 = "";

	if(serviceid != "" && day != "" && time != ""){
	$("#loadduration").load('frontend/show_duration.php?service='+serviceid+'&date='+day+'&time='+time);
	}
	
	if(time != "" && serviceid != "" && durationid != ""){
		$("#loadtherapists").load('frontend/show_therapists.php?duration='+durationid+'&date='+day+'&time='+time);
	}
	
	});

});