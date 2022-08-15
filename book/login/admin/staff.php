<?php

// Initialize the session
session_start();
    $id = $_SESSION["id"]; 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 1){
    header("location: ../core/login.php");
    exit;
}

// Include files
include "../core/admin.classes.php";
$show = new Staff;
$show->get_staff();

//Delete user
if(isset($_POST['delete'])) 
{
	$user_id = $_POST["delete"];
	$delete_user = "DELETE FROM users WHERE id='$user_id'";
	$delete_user_service = "DELETE FROM users_services WHERE user_id='$user_id'";	
	$delete_working_time = "DELETE FROM working_times WHERE user_id ='$user_id'";
	
	if ($link->query($delete_user) === TRUE && $link->query($delete_working_time) === TRUE && $link->query($delete_user_service) === TRUE) {
		header( "location:staff.php");
	}else {
		echo "Error deleting record: " . $link->error;
	}
}

//Edit user
if(isset($_POST['edit'])) 
{
session_start();
$_SESSION['user_edit_id'] = $_POST['edit'];
header( "location:edit_user.php"); 
}	

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Staff</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body style="background-color: #fff !important;">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>		
  <div class="content">
	<p>Staff</p>
		<div class="new">
			<a href="new_user.php"><button type="button" class="btn ">
				<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
			</button></a>
		</div>
	<hr>
<form method='post'>
<div class="row">
<?php 
if($show->id != NULL){
foreach($show->id as $index => $value) 
{ 
	if($show->isactive[$index] == 1){
		$active = "checked";
	}else{
		$active = "";
	}
	if($show->avatar[$index] != ""){
		$avatar = $show->avatar[$index];
	}else{
		$avatar = "uploads/img/users/default.png";
	}

	if($show->firstname[$index] != ""){
		$name = $show->firstname[$index];
	}else{
		$name = "-";
	}	
 $output = "<div class='column'>";
    $output .= "<div class='card'>";
      $output .= "<div class='panel'>";
		$output .= "<div class='img'>";
	        $output .= "<img src='../".$avatar."'  style='width:130px; height:130px;'>";
			$output .= "</div>";
        $output .= "<h2>".$name."</h2>";
		$output .= "<div class='buttons'>";
					$output .= "<label class='switch'>";
						$output .= "<input type='checkbox' name='isactive' value='".$show->id[$index]."' class='switch-input' ".$active.">";
						$output .= "<span class='switch-label' ></span>";
						$output .= "<span class='switch-handle'></span>";
					$output .= "</label>";
					$output .= "<button type='submit' name='edit' value='".$show->id[$index]."' class='btn own'>";
						$output .= "<span class='glyphicon glyphicon-pencil' style='font-size:14px; margin-top: -3px;'></span>";
					$output .= "</button>";
					$output .= "<button type='submit' name='delete' value='".$show->id[$index]."' class='btn own'>";
					$output .= "<span class='glyphicon glyphicon-remove' style='font-size:14px; margin-top: -3px;'></span>";
			$output .= "</button>";
      $output .= "</div>";
	  $output .= "</div>";
    $output .= "</div>";
  $output .= "</div>";
	echo $output;
}
}
?>  
</div>
</form>
  </div>
<script>

$(document).ready(function () {
$('input:checkbox').change(function(){
userid = $(this).val();
var userstatus = "";
if(this.checked){
	userstatus = 1;
}else{
	userstatus = 0;
}

      jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'userid='+userid + '&userstatus='+userstatus,
       cache: false,	   
     });

});
});




</script>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>
