<?php
	require "../login/config/config.php";
	include "../login/config/settings.php";
	//check if service post submited
if (!empty($_GET['service']) && !empty($_GET['date']) && !empty($_GET['time'])) {
	

	$service_id = $_GET['service'];

	//select service duration row
	$sql_s_d = "SELECT id, service_id, service_name, duration, price FROM services_duration WHERE service_id='$service_id'";
	$result_s_d = mysqli_query($link, $sql_s_d); 
	//get service duration row


while ($row = mysqli_fetch_assoc($result_s_d)) { $stripped = str_replace(' ', '', $row["service_name"]);

			echo '<div class="box">';
			echo '<div class="duration">';
			echo '<span data-id="'.$row["id"].'" data-duration="'.$row["duration"].'">'.$row["duration"].' Mins <br>'.$currency_symbol.''.$row["price"].'</span>';
			echo '</div>';
			echo "</div>";
}

}else{
	echo "<p>Select Date, Time And Service First</p>";
}

			
?>

<script type="text/javascript" src="frontend/assets/js/duration-control.js"></script>		