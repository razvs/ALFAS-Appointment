<?php 

// Initialize the session
session_start();
    $id = $_SESSION["id"];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 0){
    header("location: login.php");
    exit;
}

// Include files
include "../core/admin.classes.php";
include "../config/settings.php";

$show = new Services;
$show->select_services($id);

for($i = 0; $i<= sizeof($show->service_name); $i++){
	if($show->service_name[$i] != $show->service_name[$i+1]){
		$output2 .= "<div class='panel'>\r\n";
		$output2 .= "<div class='service-name'>\r\n";
		$output2 .= "<p>".$show->service_name[$i]."</p>\r\n";
		$output2 .= "</div>\r\n";
		for($j = 0; $j<= sizeof($show->price); $j++){
		if($show->service_id[$i] == $show->service_id[$j]){
			$output2 .= "<div class='price-duration'>\r\n";
			$output2 .= "<p>".$show->duration[$j]." Min - £".$show->price[$j]."</p>\r\n";
			if($show->services_duration_id[$j] == $show->id[$j] ){
				if($show->isactive[$j] == 1){
					$active = "checked";
				}else{
					$active = "";
				}				
			
				$output2 .= "<div class='buttons'>\r\n";
					$output2 .= "<label class='switch'>\r\n";
						$output2 .= "<input type='checkbox' name='isactive' value='".$show->id[$j]."' data-id='".$id."' class='switch-input' ".$active.">\r\n";
						$output2 .= "<span class='switch-label'></span>\r\n";
						$output2 .= "<span class='switch-handle'></span>\r\n";
					$output2 .= "</label>\r\n";				
				$output2 .= "</div>\r\n";			
			$output2 .= "</div>\r\n"; 
				}			
		}	

		}
		$output2 .= "</div>\r\n";
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Services</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/bootstrap.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">		
  <div class="content">
	<p>Services</p>
	<hr>
	
				<div class="select-service">				
					<?php echo $output2; ?>
				</div>
		</div>
	</form>	
	
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

scrollingElement = (document.scrollingElement || document.body)
function scrollToBottom () {
   scrollingElement.scrollTop = scrollingElement.scrollHeight;
}

</script>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>