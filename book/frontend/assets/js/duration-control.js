$(document).ready(function () {

$(".duration").on('click', function(){
durationid = $(this).find("span").data("id");
duration = $(this).find("span").data("duration");
	$(".duration").removeClass("active");
	$(this).addClass("active");
			therapistid = "";
			therapistname = "";
			therapistid2 = "";
			therapistname2 = "";
			numItems = 0;			
$("#loadtherapists").load('frontend/show_therapists.php?duration='+durationid+'&date='+day+'&time='+time); 
$("#loadtherapists").show();
$('#selected-service').html("");
$('#therapist-warning').html("");
$("#confirmbutton").empty();
});

});