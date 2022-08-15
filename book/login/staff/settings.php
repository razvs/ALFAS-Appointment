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
include "../core/staff.classes.php";

$show = new Settings;
$show->get_settings($id);

		if($show->isactive == 1){
			$active = "checked";
		}else{
			$active = "";
		}				


		$output = "<div class='buttons' style='display: inline-block;margin: 10px;'>";
					$output .= "<label class='switch'>";
						$output .= "<input type='checkbox' name='isactive' value='".$id."' class='switch-input' ".$active.">";
						$output .= "<span class='switch-label' ></span>";
						$output .= "<span class='switch-handle'></span>";
					$output .= "</label>";
				$output .= "</div>";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Settings</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">		
  <div class="content">
	<p>Settings</p>
		<div class="new">
			<button type="submit" class="btn ">
				<span>Save</span>
			</button>
		</div>
	<hr>
	<div>
		<label>Active Account:</label>
		<?php echo $output; ?>
	</div>
  </div>
</form>

<?php include "../core/elements/footer.php"; ?>	
</body>
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
</html>