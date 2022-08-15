<?php
require "../login/config/config.php";
	if(!empty($_GET['date']) && !empty($_GET['time']) && !empty($_GET['service']) && !empty($_GET['duration']) && !empty($_GET['therapist']))
	{

		session_start();
		
		if($_GET['type'] != "Single"){
			if(!empty($_GET['therapist2'])){
			  $id = $_GET['duration'];
			  
			  $sql = "SELECT service_name, duration, price FROM services_duration WHERE id=$id";
			  $run = mysqli_query($link,$sql);
			  
			  while($row = mysqli_fetch_assoc($run)){
				  $price = $row['price'];
				  $duration = $row['duration'];
				  $service_name = $row['service_name'];
			  }

			  $id = $_GET['therapist'];
			  $id2 = $_GET['therapist2'];
			  $sql = "SELECT firstname FROM users WHERE id IN($id, $id2)";
			  $run = mysqli_query($link,$sql);
			 
			  while($row = mysqli_fetch_assoc($run)){
				  $name [] = $row['firstname'];
			  }
			  
			$therapist = $wids = join(",",$name);
			$amount = ($price*2);
		
			
			
			$_SESSION['date'] = $_GET['date'];
			$_SESSION['time'] = $_GET['time'];
			$_SESSION['type'] = $_GET['type'];
			$_SESSION['service_id'] = $_GET['service'];
			$_SESSION['duration_id'] = $_GET['duration'];
			$_SESSION['therapist_id'] = $_GET['therapist'].",".$_GET['therapist2'];
			$_SESSION['therapist'] = $therapist;			
			$_SESSION['service_name'] = $service_name;
			$_SESSION['duration'] = $duration;
			$_SESSION['price'] = $price;
			$_SESSION['amount'] = $amount;			

 
			echo '<button type="submit" class="btn" id="confirmbooking">Confirm</button>';
			
			}
			
		}else{
			
			  $id = $_GET['duration'];
			  
			  $sql = "SELECT service_name, duration, price FROM services_duration WHERE id=$id";
			  $run = mysqli_query($link,$sql);
			  
			  while($row = mysqli_fetch_assoc($run)){
				  $price = $row['price'];
				  $duration = $row['duration'];
				  $service_name = $row['service_name'];
			  }

			  $id = $_GET['therapist'];
			  
			  $sql = "SELECT firstname FROM users WHERE id=$id";
			  $run = mysqli_query($link,$sql);
			  
			  while($row = mysqli_fetch_assoc($run)){
				  $therapist = $row['firstname'];

			  }
			
			$amount = $price;
			$_SESSION['date'] = $_GET['date'];
			$_SESSION['time'] = $_GET['time'];
			$_SESSION['type'] = $_GET['type'];
			$_SESSION['service_id'] = $_GET['service'];
			$_SESSION['duration_id'] = $_GET['duration'];
			$_SESSION['therapist_id'] = $_GET['therapist'];
			$_SESSION['therapist'] = $therapist;			
			$_SESSION['service_name'] = $service_name;
			$_SESSION['duration'] = $duration;
			$_SESSION['price'] = $price;
			$_SESSION['amount'] = $amount;			
			echo '<button type="submit" class="btn" id="confirmbooking">Confirm</button>';
		}
		
	}
?>

<script type="text/javascript" src="frontend/assets/js/booking-control.js"></script>