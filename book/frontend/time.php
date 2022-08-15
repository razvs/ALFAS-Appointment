<?php
	include "../login/config/settings.php";

	$minute = array("00","30");
if(isset($_GET['date'])){
		
	$selected_date = $_GET['date'];
	$print = '';
	
	$current_time =  date("H:i");
	$current_date = date("Y-m-d");
	for($i = $start_time; $i<=$end_time;$i++){
		
	$time_input = $i.':'.$minute[0];
	$date = DateTime::createFromFormat( 'H:i', $time_input);
	$formatted = $date->format( 'H:i');

	$time_input = $i.':'.$minute[1];
	$date = DateTime::createFromFormat( 'H:i', $time_input);
	$formatted2 = $date->format( 'H:i');
		
		if($current_date == $selected_date){
			if($current_time<$formatted || $current_time<$formatted2){
			$timefull = ($i+1).':'.$minute[0];
			$timehalft = ($i+1).':'.$minute[1];
		$print .= '<div class ="times item-time"><span data-time="'.$timefull.'">'.$timefull.'</span></div>';
		$print .= '<div class ="times item-time"><span data-time="'.$timehalft.'">'.$timehalft.'</span></div>';								
			}
			
		}else{

		$print .= '<div class ="times item-time"><span data-time="'.$formatted.'">'.$formatted.'</span></div>';
		$print .= '<div class ="times item-time"><span data-time="'.$formatted2.'">'.$formatted2.'</span></div>';						
		}

	}
	
	echo $print;
	
} 
?>
<script type="text/javascript" src="frontend/assets/js/time-control.js"></script>