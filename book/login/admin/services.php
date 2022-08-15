<?php
// Initialize the session
session_start();
    $id = $_SESSION["id"]; 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 1){
    header("location: ../core/login.php");
    exit;
}

include "../core/admin.classes.php";

//Delete Service
if (isset($_POST['delete'])) 
{
	$delete = new services;
	$delete->delete_service($_POST["delete"]);
}

//Edit Service
if (isset($_POST['edit'])) 
{
session_start();
$_SESSION['service_edit_id'] = $_POST['edit'];
header( "location:edit_service.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Services</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body>
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>		
  <div class="content">
	<p>Services</p>
		<div class="new">
			<a href="new_service.php"><button type="button" class="btn ">
				<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
			</button></a>
		</div>
	<hr>
	<form method='post'>
<?php 
$show = new services;
$show->get_services();
if($show->id != NULL){
foreach($show->id as $index => $value) 
{ 
	if($show->isactive[$index] == 1){
		$active = "checked";
	}else{
		$active = "";
	}
	$output = "<div class='service-list'>";
		$output .= "<div class='service-img'>";
			$output .= "<img src='../".$show->service_img[$index]."'>";
		$output .= "</div>";
				$output .= "<div class='details'><p><span id='title'>".$show->service_name[$index]."</span>";
				$output .= "<span id='desc'>".$show->service_desc[$index]."</span></p></div>";
				$output .= "<div class='buttons'>";
					$output .= "<label class='switch'>";
						$output .= "<input type='checkbox' name='isactive' value='".$value."' class='switch-input' ".$active.">";
						$output .= "<span class='switch-label'></span>";
						$output .= "<span class='switch-handle'></span>";
					$output .= "</label>";
					$output .= "<button type='submit' name='edit' value='".$value."' class='btn own'>";
						$output .= "<span class='glyphicon glyphicon-pencil' style='font-size:20px;'></span>";
					$output .= "</button>";
					$output .= "<button type='submit' name='delete' value='".$value."' class='btn own'>";
						$output .= "<span class='glyphicon glyphicon-remove' style='font-size:20px;'></span>";
					$output .= "</button>";					
				$output .= "</div>";
	$output .= "</div>";
	echo $output;
}	
}
?>
</form>
  </div>
<script>
$(document).ready(function () {
$('input:checkbox').change(function(){
id = $(this).val();
var status = "";
if(this.checked){
	status = 1;
}else{
	status = 0;
}
      jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'id='+id + '&status='+status,
       cache: false,	   
     });

});
});
</script>
<?php include "../core/elements/footer.php"; ?>	
</body>
</html>