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
					$service_img = "uploads/img/services/empty.jpg";
				}

	// Check input errors before inserting in database
	if(empty($service_name_err) && empty($d_p_number_err))
	{
		$insert = new services;
		$insert->insert_service($service_name,$service_desc,$service_img,$duration_array,$price_array);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Create new service</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/add_input.js"></script>		
</head>
<body style="background-color:#fff !important;">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <div class="content">
	<p>Create new services</p>
		<div class="new">
			<button type="submit" class="btn ">
				<span>Save</span>
			</button>
		</div>
	<hr>
<div class='new-service'>
	<div class="img">
		<label for="service-img">
			<img src="../uploads/img/services/add_img.png" id="service-img-tag" width="150px" />
		</label>					
			<input id="service-img" type="file" name="upload_service"/>					
	</div>
		<div class="name">
			<label>Name</label>
				<input type="text" name="service_name" required>
				</div>
			<div class="desc">	
			<label>Description</label>
				<textarea name="service_desc"  placeholder="Describe the service..."></textarea>															
			</div>			
	</div>
		<div class="duration-panel add_duration">
	<?php
		$output = '<div>';	
		$output = '<div class="field">';
			$output .= '<label>Minutes</label><input type="text" name="duration[]"  placeholder="0" required onkeypress="return isNumberKey(event)">';
		$output .= '</div>';
		$output .= '<div class="field">';
			$output .= '<label>Price</label><input type="text" name="price[]" placeholder="0"   required onkeypress="return isNumberKey(event)">';
		$output .= '</div>';
			$output .= '<button type="button" class="btn add_form_field" style="background-color:#181841; color:#fff" onClick="scrollToBottom()" >';
				$output .= '<span class="glyphicon glyphicon-plus" style="font-size:14px; "></span>';
			$output .= '</button>';
		$output .= '</div>';			
			echo $output; 
	?>
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

                $('#service-img-tag').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#service-img").change(function(){

        readURL(this);

    });

scrollingElement = (document.scrollingElement || document.body)
function scrollToBottom () {
   scrollingElement.scrollTop = scrollingElement.scrollHeight;
}

</script>
</body>
</html>
