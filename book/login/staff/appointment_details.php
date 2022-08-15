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
include "../core/admin.classes.php";

$app_id = $_POST["app_id"];
$show = new Appointments;
$show->get_appointment($_POST["app_id"]);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Appointment Details</title>
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>

  <div class="content">
	<p>Appointment Details</p>
		<div class="new">
			<a href="appointments.php"><button role="button" class="btn">
				<span>Back</span>
			</button></a>
		</div>
	<hr>
		<label class="col-sm-2 control-label">Date:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="date" value="<?php echo $show->selected_date; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Time:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="time" value="<?php echo $show->selected_time; ?>" readonly>
			</div>			
		<label class="col-sm-2 control-label">Service:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="service" value="<?php echo $show->selected_service; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Therapist:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="therapist" value="<?php echo $show->selected_therapist; ?>" readonly>
			</div>				
		<label class="col-sm-2 control-label">Duration:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="duration" value="<?php echo $show->selected_duration; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Type:</label>
			<div class="col-md-4 form-group">
				<input name="type" class="form-control" type="text" value="<?php echo $show->selected_type; ?>" readonly>
			</div>			
		<label class="col-sm-2 control-label">Customer Firstname:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="firstname" value="<?php echo $show->firstname; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Customer Lastname:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="lastname" value="<?php echo $show->lastname; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Postcode:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="postcode" value="<?php echo $show->post_code; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Address:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="address" value="<?php echo $show->address; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Phone Number:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="phone" value="<?php echo $show->phone_number; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Email Address:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="email" value="<?php echo $show->email; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Payby:</label>
			<div class="col-md-4 form-group">
				<input class="form-control" type="text" name="payby" value="<?php echo $show->payby; ?>" readonly>
			</div>
		<label class="col-sm-2 control-label">Amount: <a><?php echo $currency_symbol; ?></a></label>
			<div class="col-md-4 form-group">
				<input name="amount" class="form-control" type="text" value="<?php echo $show->amount; ?>" readonly>
			</div>				
		<label class="col-sm-2 control-label">Notes:</label>
			<div class="col-md-8 form-group">
				<textarea name="note" class="form-control" style="resize: none; width:300px; height:150px;" readonly><?php echo $show->message; ?></textarea>
			</div>
		<label>Created at: <a><?php echo $show->created_at; ?></a></label>				
	</div>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>