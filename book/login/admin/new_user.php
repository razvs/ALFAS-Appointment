<?php
// Include files
require_once "../config/config.php";
// Initialize the session
session_start();
    $id = $_SESSION["id"];	
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 1){
    header("location: ../core/login.php");
    exit;
}


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

if($_FILES["upload_profile"]["error"] != 4){
	
    		// file name, type, size, temporary name
    		$file_name = $_FILES['upload_profile']['name'];
    		$file_type = $_FILES['upload_profile']['type'];
    		$file_tmp_name = $_FILES['upload_profile']['tmp_name'];
    		$file_size = $_FILES['upload_profile']['size'];
     
    		// target directory
    		$target_dir = "../uploads/img/users/";
    	
    		// uploding file
    		if(move_uploaded_file($file_tmp_name,$target_dir.$file_name))
    		{
				$profile_img = "uploads/img/users/".$file_name;
			}
			else
				{
					$profile_img = "uploads/img/users/default.png";
				}	

}else{
	$profile_img = $avatar;
}

    // Validate firstname
    if(empty($_POST["firstname"])){
        $firstname_err = "Please enter a firstname.";     
    } else{
        $firstname = $_POST["firstname"];
    }	

    // Validate username
    if(empty($_POST["username"])){
        $username_err = "Please enter a username.";     
    } else{
        $username = $_POST["username"];
    }

    // Validate lastname
    if(empty($_POST["lastname"])){
        $lastname_err = "Please enter a lastname.";     
    } else{
        $lastname = $_POST["lastname"];
    }
	    $email = $_POST["email"];
    // Validate email address
    if(empty($_POST["email"])){
        $email_err = "Please enter your Email Addres.";     
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_err = "Please enter valid email addres.";     
    } else{
        $email = $_POST["email"];
    }  
	    $mobile_number = $_POST["mobile_number"];
    // Validate phone number
    if(empty($_POST["mobile_number"])){
        $mobile_number_err = "";     
    }elseif (!filter_var($mobile_number, FILTER_VALIDATE_INT)) {
		$mobile_number_err = "Please enter valid phone number.";     
    } else{
        $mobile_number = $_POST["mobile_number"];
    } 

	if(!empty($_POST["aboutme"])){
		$aboutme = $_POST["aboutme"];
	}

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

		$password = password_hash($new_password, PASSWORD_DEFAULT);	

	// Check input errors before inserting in database
	if(empty($email_err) && empty($new_password_err) && empty($confirm_password_err) && empty($username_err)){
	// query
	$q = "INSERT INTO users (username, password, avatar, email, aboutme, firstname, lastname, mobile_number) VALUES ('$username', '$password', '$profile_img', '$email', '$aboutme', '$firstname', '$lastname', '$mobile_number')";	


if ($link->query($q) === TRUE) {
    $last_id = $link->insert_id;
	$sql_insert = "INSERT INTO `working_times` (`user_id`, `type`, `monday_from`, `monday_to`, `monday_lunch_from`, `monday_lunch_to`, `monday_dayoff`, `tuesday_from`, `tuesday_to`, `tuesday_lunch_from`, `tuesday_lunch_to`, `tuesday_dayoff`, `wednesday_from`, `wednesday_to`, `wednesday_lunch_from`, `wednesday_lunch_to`, `wednesday_dayoff`, `thursday_from`, `thursday_to`, `thursday_lunch_from`, `thursday_lunch_to`, `thursday_dayoff`, `friday_from`, `friday_to`, `friday_lunch_from`, `friday_lunch_to`, `friday_dayoff`, `saturday_from`, `saturday_to`, `saturday_lunch_from`, `saturday_lunch_to`, `saturday_dayoff`, `sunday_from`, `sunday_to`, `sunday_lunch_from`, `sunday_lunch_to`, `sunday_dayoff`) VALUES
	($last_id, 'calendar', '09:30:00', '18:30:00', '12:30:00', '13:30:00', 'F', '09:00:00', '18:00:00', '12:30:00', '13:30:00', 'F', '09:45:00', '17:30:00', '11:00:00', '12:00:00', 'F', '09:00:00', '18:00:00', '12:30:00', '13:30:00', 'F', '09:00:00', '18:00:00', '12:30:00', '13:30:00', 'F', '09:30:00', '18:30:00', '12:30:00', '13:30:00', 'T', '09:30:00', '18:30:00', '12:30:00', '13:30:00', 'T')";
	$sql_insert = mysqli_query($link,$sql_insert); 

$sql = "SELECT id, service_id FROM services_duration";
$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_assoc($result))
{
$sd_id = $row["id"];
$s_id = $row["service_id"];
	$sql = "INSERT INTO users_services (user_id, services_duration_id, service_id, isactive)
	VALUES ('$last_id', '$sd_id', '$s_id', '1')";
$run = mysqli_query($link, $sql);
}  
}

  
    // Close connection
	mysqli_close($link);
	header("location: staff.php");
	}
		
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>New user</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">		
  <div class="content">
	<p>New user</p>
		<div class="new">
			<button type="submit" class="btn ">
				<span>Save</span>
			</button>
		</div>
	<hr>
	<div class="profile">
	<div class="profile-img">
		<span>Profile Picture</span>
		<hr>
		<div class="panel">
		<label for="profile-img-up">
			<img src="../uploads/img/users/add_img.png" id="profile-img-up-tag" width="150px" />
		</label>					
			<input id="profile-img-up" type="file" name="upload_profile"/>	
		</div>
	</div>
	<div class="profile-details">
		<span>Profile Details</span>
		<hr>
		<div class="panel">
							<div class="group">
						<label>User name *</label>
					<input type="text" name="username" required>
				</div>
					<div class="group">
						<label>First name *</label>
					<input type="text" name="firstname" required>
				</div>
					<div class="group">
						<label>Last name</label>
					<input type="text" name="lastname" >
				</div>
				<div class="group"><span><?php echo $email_err; ?></span>
					<label>Email *</label>
				<input type="text" name="email" required>
				</div>	
		</div>
	</div>	
</div>
	<div class="profile-desc">
		<span>Profile Description</span>
		<hr>
		<div class="panel">
						<textarea name="aboutme"  placeholder="Describe yourselft..."></textarea>		
		</div>
	</div>
	<div class="profile-pw">
		<span>Password</span>
		<hr>
		<div class="panel">
						<label>Password *</label>
							<input id="newpw" type="password" name="new_password" required>
						<label>Confirm password *</label>	
							<input id="conpw" type="password" name="confirm_password" required>
								<p id="pw_err"></p>		
		</div>
	</div>		
</form>
  </div>
<script>
	$(document).ready(function () {
$("#newpw").bind("change paste keyup", function() {
	var newpw = $('#newpw').val();
	var conpw = $('#conpw').val();
	if(newpw.length<6){
		$('#pw_err').text("Password must have atleast 6 characters.");
	}else if(conpw != "" && conpw != newpw){
		$('#pw_err').text("Password did not match.");
	}else{
		$('#pw_err').text("");
	}
});

$("#conpw").bind("change paste keyup", function() {
	var newpw = $('#newpw').val();
	var conpw = $('#conpw').val();
	if(conpw != newpw){
		$('#pw_err').text("Password did not match.");
	}else if(newpw.length<6){
		$('#pw_err').text("Password must have atleast 6 characters.");
	}else{
		$('#pw_err').text("");
	}	
});

});

    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            

            reader.onload = function (e) {

                $('#profile-img-up-tag').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#profile-img-up").change(function(){

        readURL(this);

    });


</script>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>