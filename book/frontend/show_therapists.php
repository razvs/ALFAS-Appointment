<?php
	include "../login/config/settings.php";
	require "../login/config/config.php";

/*&& $_GET['date']!=""*/
if (!empty($_GET['duration']) && !empty($_GET['time']) && !empty($_GET['date'])) 
{

			$sd_id = $_GET['duration'];
			$s_time = $_GET['time'];
			$s_date = $_GET['date'];
			
		include "therapist_selector.php";

			
					//string convert to time
					$time_input = $_GET['time'];
					$date = DateTime::createFromFormat( 'H:i', $time_input);
					$formatted = $date->format( 'H:i:s');			
			
		//select service id
		$sql = "SELECT duration FROM services_duration WHERE id=$sd_id";
		$run = mysqli_query($link, $sql);
		
		while($row = mysqli_fetch_assoc($run))
		{
			$duration = $row['duration'];
			
		}

	


	$selected_day = date_format($date,"l");	
	$selected_day_from = $selected_day.'_from';
	$selected_day_to = $selected_day.'_to';
	$selected_day_lunch_from = $selected_day.'_lunch_from';	
	$selected_day_lunch_to = $selected_day.'_lunch_to';
						

					
		//select user_id if it is in selected service and selected time
		$sql_u_s = "SELECT id, user_id FROM users_services WHERE services_duration_id=$sd_id && isactive != 0  && user_id IN('$wids')";
		$result_u_s = mysqli_query($link, $sql_u_s); 
		$user_id=array();
	while ($row = mysqli_fetch_assoc($result_u_s)) 
	{
		$user_id[]=$row['user_id'];
	}
		$ids = join("','",$user_id);


					
		//munka idők lekérdezése
		$sql_working_time = "SELECT user_id, $selected_day_from, $selected_day_to, $selected_day_lunch_from, $selected_day_lunch_to FROM working_times WHERE user_id IN('$ids')";
		
		$result_working_time = mysqli_query($link,$sql_working_time);
		$id = array();
		while($row = mysqli_fetch_assoc($result_working_time)){
			
					$time = strtotime($row[$selected_day_lunch_from]);
					$time = $time - ($duration * 60);
					$date = date("H:i", $time);			
			
			
			if(strtotime($formatted) >= strtotime($row[$selected_day_from]) && 
				strtotime($formatted) <= strtotime($row[$selected_day_to]) &&
				(strtotime($formatted) <= strtotime($date) || strtotime($formatted) >= strtotime($row[$selected_day_lunch_to]))){
				$id[] = $row['user_id'];
			}
					
		}


		$sql = "SELECT selected_therapist_id, selected_duration, selected_time FROM appointments WHERE selected_date ='$s_date'";
		$r = mysqli_query($link,$sql);
		$logic = false;
		while($row = mysqli_fetch_assoc($r))
		{
			$selected_duration = $row['selected_duration'];
			$time = $row['selected_time'];

					$time_minus = strtotime($time);
					$time_minus = $time_minus-($before_time*60)-($duration*60);
					$date_minus = date("H:i:s", $time_minus);

					$time_plus = strtotime($time);
					$time_plus = $time_plus+($after_time*60)+($selected_duration*60);
					$date_plus = date("H:i:s", $time_plus);			
			
			if($s_time < $date_minus || $s_time >= $date_plus)
			{

					
				
			}else
			{
				$id_booked = $row['selected_therapist_id'];
			}  
			
		}
		
		$booked_id = explode("','", $id_booked);
		$difference = array_diff($id, $booked_id);
		$id_done = join("','",$difference);


		//select user avatar if working day selected
		$sql_avatar = "SELECT id, avatar, firstname FROM users WHERE id IN('$id_done')";
		$result_avatar = mysqli_query($link, $sql_avatar);
	if(mysqli_num_rows($result_avatar) > 0){	
		while ($row = mysqli_fetch_assoc($result_avatar)) 
		{
			 if(!empty($row["avatar"])){
				 $therapist_img = $row["avatar"];
			 }else{
				$therapist_img = "uploads/img/users/default.png";
			 }

				echo '<div class="box">';
				echo '<div class="therapist">';
				echo '<img src="login/'.$therapist_img.'">';
				echo '<span data-id="'.$row["id"].'" data-name="'.$row["firstname"].'"></span>';
				echo '<span>'.$row["firstname"].'</span>';			
				echo '</div>';
				echo '</div>';				
		
		}
	}else{
		echo "<p>No available therapist</p>";
	}
}else{
	echo "Select Date, Time, Service And Duration First";
}


?>

<script type="text/javascript" src="frontend/assets/js/therapist-control.js"></script>