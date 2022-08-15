<?php
	//select services row
	$sql_get_service = "SELECT id, service_name, service_desc, service_img FROM services WHERE isactive != 0";
	$result_service = mysqli_query($link, $sql_get_service ); 
	//get services row
	while ($row = mysqli_fetch_assoc($result_service)) 
	{ $stripped = str_replace(' ', '', $row["service_name"]);	


			echo '<div class="col-lg-3 col-md-6 col-sm-6 mb-5 box">';
			echo '<div class="service">';
			echo '<span data-id="'.$row["id"].'" data-name="'.$row["service_name"].'"><img src=login/'.$row["service_img"].'></span>';
			echo '<p>'.$row["service_name"].'</p>';
			echo '</div>';			
			echo '</div>';
	}					
?>