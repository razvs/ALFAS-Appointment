<?php
require "../login/config/config.php";
session_start();


if(empty(@$_POST['firstname'])){
	$firstname_err = "Please Enter Your firstname";
}

if(empty(@$_POST['lastname'])){
	$lastname_err = "Please Enter Your lastname";
}
	
if(empty(@$_POST['email'])){
	$email_err = "Please Enter a Valid Email";
}else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$email_err = "";
} else {
	$email_err = "Please Enter a Valid Email";
}



if(empty(@$_POST['postcode'])){
	$postcode_err = "Please Enter a Valid Postcode";
}

if(empty(@$_POST['phone'])){
	$phone_err = "Please Enter a Valid phone Number";
}

if(empty(@$_POST['address'])){
	$address_err = "Please Enter a Valid Address";
}

if(empty(@$_POST['payby'])){
	$payby_err = "Please Choose A Payment Method";
}

if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($postcode_err) && empty($phone_err) && empty($address_err) && empty($payby_err))
{
	$firstname = @$_POST['firstname'];
	$lastname = @$_POST['lastname'];
	$mail = @$_POST['email'];
	$postcode = @$_POST['postcode'];
	$phone = @$_POST['phone'];
	$address = @$_POST['address'];
	$payby = @$_POST['payby'];
	$message = @$_POST['message'];
	$date = $_SESSION['date'];
	$time = $_SESSION['time'];
	$therapist_id = $_SESSION['therapist_id'];
	$service_name = $_SESSION['service_name'];
	$duration = $_SESSION['duration'];
	$price = $_SESSION['price'];
	$therapist = $_SESSION['therapist'];
	$type = $_SESSION['type'];
	$amount = $_SESSION['amount'];	

$sql = "INSERT INTO appointments (firstname, lastname, email, phone_number,
 post_code, address, selected_therapist, selected_therapist_id, 
 selected_service, selected_duration, selected_type, selected_date, 
 selected_time, message, payby, amount, status) VALUES ('$firstname', '$lastname', '$mail', '$phone', '$postcode',
 '$address', '$therapist', '$therapist_id', '$service_name', '$duration', '$type', '$date', '$time', '$message', '$payby', '$amount', 'pending')";

$run = mysqli_query($link,$sql); 

	
	$sql = "INSERT INTO clients (email, firstname, lastname, mobile_number)
SELECT * FROM (SELECT '$mail', '$firstname', '$lastname', '$phone') AS tmp
WHERE NOT EXISTS (
    SELECT email FROM clients WHERE email = '$mail'
) LIMIT 1;";
	$run = mysqli_query($link,$sql);
    
	$res = "succes";
	echo json_encode($res);
	
// destroy the session
session_destroy();	
	
}
		
 		
?>