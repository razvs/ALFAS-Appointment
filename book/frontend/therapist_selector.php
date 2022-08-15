<?php

	$sql = "SELECT id from users WHERE isactive != 0";
	$run = mysqli_query($link,$sql);
	
	$users_active=array();
	while($row = mysqli_fetch_assoc($run)){
		$users_active [] = $row["id"];
	}
	$users_active_join = join("','",$users_active);
	
		$selected_date = $_GET['date'];
		$date=date_create($selected_date);
		
		//creare array for user_id
		$users_wid=array();
		//select working_times row
		$sql_select_w_t = "SELECT `user_id`, `monday_dayoff`, `tuesday_dayoff`, `wednesday_dayoff`, `thursday_dayoff`, `friday_dayoff`, `saturday_dayoff`, `sunday_dayoff` FROM working_times WHERE user_id IN ('$users_active_join')";
		$result_w_t = mysqli_query($link, $sql_select_w_t); 
	while ($row = mysqli_fetch_assoc($result_w_t))
	{	

	
	//day off
	$monday_off = $row["monday_dayoff"];
	$tuesday_off = $row["tuesday_dayoff"];
	$wednesday_off = $row["wednesday_dayoff"];
	$thursday_off = $row["thursday_dayoff"];
	$friday_off = $row["friday_dayoff"];
	$saturday_off = $row["saturday_dayoff"];
	$sunday_off = $row["sunday_dayoff"];

		if(date_format($date,"l")=="Monday" && $monday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Tuesday" && $tuesday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Wednesday" && $wednesday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Thursday" && $thursday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Friday" && $friday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Saturday" && $saturday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
		if(date_format($date,"l")=="Sunday" && $sunday_off == "F")
		{
			$users_wid[]=$row["user_id"];
		}
						
	}

			$wids = join("','",$users_wid);
?>			