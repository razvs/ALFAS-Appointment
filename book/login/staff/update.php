<?php
/* [INIT] */
require "../config/config.php";

$var_id = @$_POST['id'];
$var_status = @$_POST['status'];
if(isset($var_id) && isset($var_status) ){
$sql = "UPDATE services SET isactive='$var_status' WHERE id='$var_id'";
	// run query
	$r = mysqli_query($link,$sql);
    // Close connection
	mysqli_close($link);	
}

$app_id = @$_POST['app_id'];
$app_status = @$_POST['app_status'];
if(isset($app_id) && isset($app_status) ){
$sql = "UPDATE appointments SET status='$app_status' WHERE id='$app_id'";
	// run query
	$r = mysqli_query($link,$sql);
    // Close connection
	mysqli_close($link);	
}

$var_userid = @$_POST['userid'];
$var_userstatus = @$_POST['userstatus'];
if(isset($var_userid) && isset($var_userstatus) ){
$sql2 = "UPDATE users SET isactive='$var_userstatus' WHERE id='$var_userid'";
	// run query
	$r2 = mysqli_query($link,$sql2);
    // Close connection
	mysqli_close($link);
}
$user_id = @$_POST['user_id'];
$service_id = @$_POST['service_id'];
$service_status = @$_POST['service_status'];
if(isset($service_id) && isset($service_status) ){
$sql3 = "UPDATE users_services SET isactive='$service_status' WHERE services_duration_id='$service_id' AND user_id='$user_id'";
	// run query
	$r3 = mysqli_query($link,$sql3);
//get row
while ($row = mysqli_fetch_assoc($r3)) 
{ 
	
}

    // Close connection
	mysqli_close($link);
}
?>