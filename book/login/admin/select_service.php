<?php 

// Initialize the session
session_start();
    $id = $_SESSION["id"];
	$edit_id = $_SESSION['user_edit_id'];	
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 1){
    header("location: ../core/login.php");
    exit;
}

// Include files
include "../core/admin.classes.php";
include "../config/settings.php";

$show = new Services;
$show->select_services($edit_id);

for($i = 0; $i<= sizeof($show->service_name); $i++){
	if($show->service_name[$i] != $show->service_name[$i+1]){
		$output2 .= "<div class='panel'>";
		$output2 .= "<div class='service-name'>";
		$output2 .= "<p>".$show->service_name[$i]."</p>";
		$output2 .= "</div>";
		for($j = 0; $j<= sizeof($show->price); $j++){
		if($show->service_id[$i] == $show->service_id[$j]){
			$output2 .= "<div class='price-duration'>";
			$output2 .= "<p>".$show->duration[$j]." Min - ".$currency_symbol."".$show->price[$j]."</p>";
			if($show->services_duration_id[$j] == $show->id[$j] ){
				if($show->isactive[$j] == 1){
					$active = "checked";
				}else{
					$active = "";
				}				
			
				$output2 .= "<div class='buttons'>";
					$output2 .= "<label class='switch'>";
						$output2 .= "<input type='checkbox' name='isactive' value='".$show->id[$j]."' data-id='".$edit_id."' class='switch-input' ".$active.">";
						$output2 .= "<span class='switch-label'></span>";
						$output2 .= "<span class='switch-handle'></span>";
					$output2 .= "</label>";				
				$output2 .= "</div>";			
			$output2 .= "</div>";
				}			
		}	

		}
		$output2 .= "</div>";
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Profile</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<div class="tab-panel">
    <ul class="nav nav-tabs" id="edit_user_tab">
        <li><a href="edit_user.php"><i class="glyphicon glyphicon-th-list"></i>Details</a></li>
        <li><a href="working_time.php"><i class="glyphicon glyphicon-time"></i>Working Time</a></li>
        <li class="active"><a href="select_service.php"><i class="glyphicon glyphicon-cog"></i>Service</a></li>		
    </ul>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="content">
		<p>Select service</p>
	<hr>	
		<div class="select-service">				
			<?php echo $output2; ?>
		</div>
	</div>
	</form>
</div>	
<script>
	$(document).ready(function () {
$('input:checkbox').change(function(){
service_id = $(this).val();
user_id = $(this).data('id');
var service_status = "";
if(this.checked){
	service_status = 1;
}else{
	service_status = 0;
}

      jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'service_id='+service_id + '&service_status='+service_status + '&user_id='+user_id,
       cache: false,	   
     });

});

});
</script>
<?php include "../core/elements/footer.php"; ?>	
</body>
</html>
