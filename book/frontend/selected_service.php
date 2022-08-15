<?php
include "../login/config/settings.php";

if (!empty($_GET['duration'])) 
{
			$sd_id=$_GET['duration'];

		$sql_s_d = "SELECT service_name, duration, price FROM services_duration WHERE id=$sd_id";
		$result_s_d = mysqli_query($link, $sql_s_d);

	while ($row = mysqli_fetch_assoc($result_s_d)) 
	{
		
		$service_name_echo = "<a>".$row[service_name]."</a>";
		$service_duration_echo = "<a>".$row[duration]." Minutes</a>";
		$service_price_echo = "<a>".$currency_symbol." ".$row[price]."</a>";		
	}

	
}
if(!empty($_GET['therapist'])){
	$id = $_GET['therapist'];
	$sql = "SELECT firstname FROM users WHERE id=$id";
	$result = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_assoc($result)) 
	{
		
			$therapist_name_echo = $row['firstname'];
	}

}
if(!empty($_GET['therapist2'])){
	$id = $_GET['therapist2'];
	$sql = "SELECT firstname FROM users WHERE id = $id";
	$result = mysqli_query($link,$sql);
	while($row = mysqli_fetch_assoc($result)){
		
			$therapist2_name_echo = $row['firstname'];
	}

}

?>	