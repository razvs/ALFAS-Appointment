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
$show = new Profile;
$show->get_profile($id);

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
	$profile_img = $show->avatar;
}
    // Validate firstname
    if(empty($_POST["firstname"])){
        $firstname_err = "Please enter a firstname.";     
    } else{
        $firstname = $_POST["firstname"];
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

		$pw = password_hash($new_password, PASSWORD_DEFAULT);	

		// Check input errors before inserting in database
		if(empty($email_err) && empty($mobile_number_err)){
		$update = new Profile;
		$update->update_profile($id,$profile_img,$firstname,$lastname,$email,$mobile_number,$aboutme);

		if(!empty($new_password)){
			if(empty($new_password_err) && empty($confirm_password_err)){
				$update_pw = new Profile;
				$update_pw->update_profile_pw($id,$pw);
			}
		}
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Profile</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">		
  <div class="content">
	<p>Profile</p>
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
			<img src="../<?php if(!empty($show->avatar)){echo $show->avatar;}else{echo "uploads/img/users/add_img.png";} ?>" id="profile-img-up-tag" width="150px" />
		</label>					
			<input id="profile-img-up" type="file" name="upload_profile"/>	
		</div>
	</div>
	<div class="profile-details">
		<span>Profile Details</span>
		<hr>
		<div class="panel">
					<div class="group">
						<label>First name</label>
					<input type="text" name="firstname"   value="<?php echo $show->firstname; ?>">
				</div>
					<div class="group">
						<label>Last name</label>
					<input type="text" name="lastname"  value="<?php echo $show->lastname; ?>" >
				</div>
				<div class="group"><span><?php echo $email_err; ?></span>
					<label>Email</label>
				<input type="text" name="email"  value="<?php echo $show->email; ?>" >
				</div>
				<div class="group"><span><?php echo $mobile_number_err; ?></span>
					<label>Mobile</label>
				<input type="text" name="mobile_number"  value="<?php echo $show->mobile_number; ?>" >
			</div>		
		</div>
	</div>	
</div>
	<div class="profile-desc">
		<span>Profile Description</span>
		<hr>
		<div class="panel">
						<textarea name="aboutme"  placeholder="Describe yourselft..."><?php echo $show->aboutme; ?></textarea>		
		</div>
	</div>
	<div class="profile-pw">
		<span>Change Password</span>
		<hr>
		<div class="panel">
						<label>New password</label>
							<input id="newpw" type="password" name="new_password">
						<label>Confirm password</label>	
							<input id="conpw" type="password" name="confirm_password">
								<p id="pw_err"></p>		
		</div>
	</div>		
  </div>
</form>  
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
	//Kiválasztot kép megjelenítése.
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