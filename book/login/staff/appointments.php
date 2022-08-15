<?php

// Initialize the session
session_start();
    $id = $_SESSION["id"];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 0){
    header("location: ../core/login.php");
    exit;
}

// Include files
include "../config/settings.php";
include "../core/staff.classes.php";

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Appointments</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	    

</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
  <div class="content">
	<p>Appointments</p>
	<hr>
<div style="overflow-x:auto;">
<form method="post" action="appointment_details.php">

<table id="client_table">
  <tr class="header">
    <th style="width:10%;">ID</th>
    <th style="width:10%;">Date/Time</th> 	
    <th style="width:30%;">Customer details</th>
    <th style="width:10%;">Total</th>
    <th style="width:20%;">Service/Therapist</th>	
    <th style="width:30%;">Status</th>	
    <th style="width:10%;">Details</th>		
  </tr>
<?php 
$show = new Appointments;
$show->get_appointments($id);
$status_array = array("pending", "confirmed", "declined");
if($show->id != NULL){
	foreach($show->id as $index => $value){
	  $output = "<tr>\r\n";
		$output .= "<td>".$show->id[$index]."</td>\r\n";
		$output .= "<td>".$show->selected_date[$index]."<br>".$show->selected_time[$index]."</td>\r\n"; 	
		$output .= "<td>".$show->firstname[$index]." ".$show->lastname[$index]."<br>".$show->email[$index]."<br>".$show->phone_number[$index]."</td>\r\n";
		$output .= "<td>".$currency_symbol." ".$show->amount[$index]."</td>\r\n";
		$output .= "<td>".$show->selected_service[$index]."<br>".$show->selected_therapist[$index]."</td>\r\n";
		$output .= "<td>\r\n<select data-id='".$value."' class='form-control'>\r\n<option  value='".$status_array[0]."' ". (($status_array[0]==$show->status[$index])?'selected="selected"':"") .">".$status_array[0]."</option>\r\n<option value='".$status_array[1]."' ". (($status_array[1]==$show->status[$index])?'selected="selected"':"") .">".$status_array[1]."</option>\r\n<option value='".$status_array[2]."' ". (($status_array[2]==$show->status[$index])?'selected="selected"':"") .">".$status_array[2]."</option>\r\n</select>\r\n</td>\r\n";		

		$output .= "<td>\r\n<button name='app_id' type='submit' value='".$value."' class='btn btn-primary'>Details</button>\r\n</td>\r\n";
	  $output .= "</tr>\r\n";
	  echo $output;  
	 
	}
}
?> 
</table>
</form>
</div>
</div>

<script>

$(document).ready(function () {
$('select').change(function(){
status = $(this).val();
id = $(this).attr("data-id");

      jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'app_status='+status+'&app_id='+id,
       cache: false,
success: function (data) {
	
}	   
     });

});
});

</script>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>