	var time = "";
	var day = "";
	var type = "Single";
	var serviceid = "";
	var servicename = "";
	var durationid = "";
	var duration = "";
	var therapistid = "";
	var therapistname = "";
	var therapistid2 = "";
	var therapistname2 = "";	
	var numItems = 0;
$(document).ready(function () {

$(".days").on('click', function(){
day = $(this).find("span").data("value");
	$(".days").removeClass("active");
	$(this).addClass("active");
		$("#loadtime").load('frontend/time.php?date='+day); 
		$("#loadtherapists").empty();	
		$("#btn-nav-time-next").show();
		$("#loadduration").empty();
		time = "";
		
		durationid = "";
});

$(".type").on('click', function(){
type = $(this).val();
	$(".type").removeClass("active");
	$(this).addClass("active");
		$("#confirmbutton").empty();
		$("#loadtherapists").empty();
		$('#selected-service').html("");
		$('#therapist-warning').html("");
		$(".duration").removeClass("active");
			therapistid = "";
			therapistname = "";
			therapistid2 = "";
			therapistname2 = "";
			durationid = "";
			duration = "";	
	
});

$(".service").on('click', function(event){
	serviceid = $(this).find("span").data("id");
	servicename = $(this).find("span").data("name");
		$(".service").removeClass("active");
		$(this).addClass("active");
		$("#loadduration").load('frontend/show_duration.php?service='+serviceid+'&date='+day+'&time='+time);
		$("#loadtherapists").empty();
		$("#confirmbutton").empty();
		$('#selected-service').html("");
		$('#therapist-warning').html("");
			therapistid = "";
			therapistname = "";
			therapistid2 = "";
			therapistname2 = "";		
		
});

});
