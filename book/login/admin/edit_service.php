<?php

// Initialize the session
session_start();
$edit_id = $_SESSION['service_edit_id'];

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] == 0){
    header("location: ../core/login.php");
    exit;
}
include "../core/admin.classes.php";
$show = new services;
$show->edit_service($edit_id);
$update = new services;
$insert = new services;
$delete = new services;
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["service_name"]))){
        $service_name_err = "Please enter service name.";     
    } else{
        $service_name = trim($_POST["service_name"]);
    }
	

	$service_desc = $_POST["service_desc"];
	$duration_array = $_POST["duration"];
	$price_array = $_POST["price"];

	$add_duration_array = $_POST["duration_add"];
	$add_price_array = $_POST["price_add"];	

	$all_numeric = false;
	foreach ($price_array as $key) { 
		if (!(is_numeric($key))) 
		{
			$all_numeric = true;
			break;
		} 
	
	}
	foreach ($duration_array as $key) { 
		if (!(is_numeric($key))) 
		{
			$all_numeric = true;
			break;
		} 
	}
		if ($all_numeric) 
		{
			$d_p_number_err = "Enter Only number";
		} 

    		// file name, type, size, temporary name
    		$file_name = $_FILES['upload_service']['name'];
    		$file_type = $_FILES['upload_service']['type'];
    		$file_tmp_name = $_FILES['upload_service']['tmp_name'];
    		$file_size = $_FILES['upload_service']['size'];
     
    		// target directory
    		$target_dir = "../uploads/img/services/";
    	
    		// uploding file
    		if(move_uploaded_file($file_tmp_name,$target_dir.$file_name))
    		{
				$service_img = "uploads/img/services/".$file_name;
			}
			else
				{
					$service_img = $show->service_img;
				}

	// Check input errors before inserting in database
	if(empty($service_name_err) && empty($d_p_number_err))
	{
		$update->update_service($edit_id,$service_name,$service_desc,$service_img);
		$update->update_duration($edit_id,$service_name,$duration_array,$price_array);
	}	


	if(!empty($add_duration_array)){
		$insert->add_duration($edit_id,$service_name,$add_duration_array,$add_price_array);
	}

	if(isset($_POST["delete"])){
	$delete->delete_duration($_POST['delete']);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Edit service</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/add_input_edit.js"></script>			
</head>
<body style="background-color:#fff !important;">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <div class="content">
	<p>Edit service</p>
		<div class="new">
			<button type="submit" class="btn ">
				<span>Save</span>
			</button>
		</div>
	<hr>
<div class='new-service'>
	<div class="img">
		<label for="profile-img">
			<img src="../<?php echo $show->service_img; ?>" id="profile-img-tag" width="200px" />
		</label>					
			<input id="profile-img" type="file" name="upload_service"/>					
	</div>
		<div class="name">
			<label>Name</label>
				<input type="text" name="service_name" value="<?php echo $show->service_name; ?>" required>
				</div>
			<div class="desc">	
			<label>Description</label>
				<textarea name="service_desc"  placeholder="Describe the service..."><?php echo $show->service_desc; ?></textarea>															
			</div>			
	</div>
		<div class="duration-panel add_duration">
<?php
	$output = "<div>\r\n";	
		$output .= "<div class='field'>\r\n";
			$output .= "<label>Minutes</label>\r\n<input type='text' name='duration[]' value='".$show->duration[0]."' placeholder='0' required onkeypress='return isNumberKey(event)'>\r\n";
		$output .= "</div>\r\n";
		$output .= "<div class='field'>\r\n";
			$output .= "<label>Price</label>\r\n<input type='text' name='price[]' placeholder='0' value='".$show->price[0]."'  required onkeypress='return isNumberKey(event)'>\r\n";
		$output .= "</div>\r\n";
			$output .= "<button type='button' class='btn add_form_field' style='background-color:#181841; color:#fff' onClick='scrollToBottom()'>\r\n";
			$output .= "<span class='glyphicon glyphicon-plus' style='font-size:14px; '></span>\r\n";
			$output .= "</button>\r\n";
	$output .= "</div>\r\n";			
	echo $output;
			
if($show->id != NULL){							
	foreach($show->id as $index => $value)
	{
		if($index>=1)
		{
			$output = "<div>\r\n";
				$output .= "<div class='field'>\r\n";
					$output .= "<label>Minutes</label>\r\n<input type='text' name='duration[]' value='".$show->duration[$index]."' placeholder='0' required onkeypress='return isNumberKey(event)'>\r\n";
				$output .= "</div>\r\n";
				$output .= "<div class='field'>\r\n";
					$output .= "<label>Price</label>\r\n<input type='text' name='price[]' placeholder='0' value='".$show->price[$index]."'  required onkeypress='return isNumberKey(event)'>\r\n";
			$output .= "</div>\r\n";	
					$output .= "<button name='delete' class='btn' value='".$value."' style='background-color:red; color:#fff;'><span class='glyphicon glyphicon-remove' style='font-size:14px; '></span></button>\r\n";
			$output .= "</div>\r\n";
			echo $output;
		}
	}
}
?>			
</div>
</div>
</form>
<?php include "../core/elements/footer.php"; ?>
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            

            reader.onload = function (e) {

                $('#profile-img-tag').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#profile-img").change(function(){

        readURL(this);

    });
</script>
</body>
</html>