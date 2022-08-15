<?php
// Include files
require_once "../config/config.php";
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
$show = new Staff;
$show->get_staff_working_time($edit_id);

//check if day off or not
if($show->monday_dayoff == "T"){
$checked_monday="checked";
}else{$checked_monday="";}
	
if($show->tuesday_dayoff == "T"){
$checked_tuesday="checked";}
else{$checked_tuesday="";}

if($show->wednesday_dayoff == "T"){
$checked_wednesday="checked";}
else{$checked_wednesday="";}

if($show->thursday_dayoff == "T"){
$checked_thursday="checked";}
else{$checked_thursday="";}

if($show->friday_dayoff == "T"){
$checked_friday="checked";}
else{$checked_friday="";}

if($show->saturday_dayoff == "T"){
$checked_saturday="checked";}
else{$checked_saturday="";}


if($show->sunday_dayoff == "T"){
$checked_sunday="checked";}
else{$checked_sunday="";}

/*------------------------------------------------------*/
//echo data
$output = "<table border=2 style='width: 100%;'>\r\n";
$output .= "<tr>\r\n";
$output .= "<th class='header'>Day of week</th>\r\n";
$output .= "<th class='header'>Is Day off</th>\r\n";
$output .= "<th class='header'>Start Time</th>\r\n";
$output .= "<th class='header'>End Time</th>\r\n";
$output .= "<th class='header'>Lunch from</th>\r\n";
$output .= "<th class='header'>Lunch to</th>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Monday</td>\r\n";
$output .= '<td><input type="checkbox" id="box1" name="monday_off" value='.$show->monday_dayoff.' '.$checked_monday.' onClick="work_update()"></td>';
$output .= "<td><p class='text'><input type='time' name='monday_start' value=".$show->monday_from."></p></td>\r\n";
$output .= "<td><p class='text'><input type='time' name='monday_end' value=".$show->monday_to."></p></td>\r\n";
$output .= "<td><p class='text'><input type='time' name='monday_lunch_start' value=".$show->monday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text'><input type='time' name='monday_lunch_end' value=".$show->monday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Tuesday</td>\r\n";
$output .= '<td><input type="checkbox" id="box2" name="tuesday_off" value='.$show->tuesday_dayoff.' '.$checked_tuesday.' onClick="work_update()"></td>';
$output .= "<td><p class='text2'><input type='time' name='tuesday_start' value=".$show->tuesday_from."></p></td>\r\n";
$output .= "<td><p class='text2'><input type='time' name='tuesday_end' value=".$show->tuesday_to."></p></td>\r\n";
$output .= "<td><p class='text2'><input type='time' name='tuesday_lunch_start' value=".$show->tuesday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text2'><input type='time' name='tuesday_lunch_end' value=".$show->tuesday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Wednesday</td>\r\n";
$output .= '<td><input type="checkbox" id="box3" name="wednesday_off" value='.$show->wednesday_dayoff.' '.$checked_wednesday.' onClick="work_update()"></td>';
$output .= "<td><p class='text3'><input type='time' name='wednesday_start' value=".$show->wednesday_from."></p></td>\r\n";
$output .= "<td><p class='text3'><input type='time' name='wednesday_end' value=".$show->wednesday_to."></p></td>\r\n";
$output .= "<td><p class='text3'><input type='time' name='wednesday_lunch_start' value=".$show->wednesday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text3'><input type='time' name='wednesday_lunch_end' value=".$show->wednesday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Thursday</td>\r\n";
$output .= '<td><input type="checkbox" id="box4" name="thursday_off" value='.$show->thursday_dayoff.' '.$checked_thursday.' onClick="work_update()"></td>';
$output .= "<td><p class='text4'><input type='time' name='thursday_start' value=".$show->thursday_from."></p></td>\r\n";
$output .= "<td><p class='text4'><input type='time' name='thursday_end' value=".$show->thursday_to."></p></td>\r\n";
$output .= "<td><p class='text4'><input type='time' name='thursday_lunch_start' value=".$show->thursday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text4'><input type='time' name='thursday_lunch_end' value=".$show->thursday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Friday</td>\r\n";
$output .= '<td><input type="checkbox" id="box5" name="friday_off" value='.$show->friday_dayoff.' '.$checked_friday.' onClick="work_update()"></td>';
$output .= "<td><p class='text5'><input type='time' name='friday_start' value=".$show->friday_from."></p></td>\r\n";
$output .= "<td><p class='text5'><input type='time' name='friday_end' value=".$show->friday_to."></p></td>\r\n";
$output .= "<td><p class='text5'><input type='time' name='friday_lunch_start' value=".$show->friday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text5'><input type='time' name='friday_lunch_end' value=".$show->friday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Saturday</td>\r\n";
$output .= '<td><input type="checkbox" id="box6" name="saturday_off" value='.$show->saturday_dayoff.' '.$checked_saturday.' onClick="work_update()"></td>';
$output .= "<td><p class='text6'><input type='time' name='saturday_start' value=".$show->saturday_from."></p></td>\r\n";
$output .= "<td><p class='text6'><input type='time' name='saturday_end' value=".$show->saturday_to."></p></td>\r\n";
$output .= "<td><p class='text6'><input type='time' name='saturday_lunch_start' value=".$show->saturday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text6'><input type='time' name='saturday_lunch_end' value=".$show->saturday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "<tr>\r\n";
$output .= "<td>Sunday</td>\r\n";
$output .= '<td><input type="checkbox" id="box7" name="sunday_off" value='.$show->sunday_dayoff.' '.$checked_sunday.' onClick="work_update()"></td>';
$output .= "<td><p class='text7'><input type='time' name='sunday_start' value=".$show->sunday_from."></p></td>\r\n";
$output .= "<td><p class='text7'><input type='time' name='sunday_end' value=".$show->sunday_to."></p></td>\r\n";
$output .= "<td><p class='text7'><input type='time' name='sunday_lunch_start' value=".$show->sunday_lunch_from."></p></td>\r\n";
$output .= "<td><p class='text7'><input type='time' name='sunday_lunch_end' value=".$show->sunday_lunch_to."></p></td>\r\n";
$output .= "</tr>\r\n";
$output .= "</table>";

//update working time
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["work_time"])){

//start time
$monday_start = $_POST["monday_start"];
$tuesday_start = $_POST["tuesday_start"];
$wednesday_start = $_POST["wednesday_start"];
$thursday_start = $_POST["thursday_start"];
$friday_start = $_POST["friday_start"];
$saturday_start = $_POST["saturday_start"];
$sunday_start = $_POST["sunday_start"];

//end time
$monday_end = $_POST["monday_end"];
$tuesday_end = $_POST["tuesday_end"];
$wednesday_end = $_POST["wednesday_end"];
$thursday_end = $_POST["thursday_end"];
$friday_end = $_POST["friday_end"];
$saturday_end = $_POST["saturday_end"];
$sunday_end = $_POST["sunday_end"];

//Lunch start
$monday_lunch_start = $_POST["monday_lunch_start"];
$tuesday_lunch_start = $_POST["tuesday_lunch_start"];
$wednesday_lunch_start = $_POST["wednesday_lunch_start"];
$thursday_lunch_start = $_POST["thursday_lunch_start"];
$friday_lunch_start = $_POST["friday_lunch_start"];
$saturday_lunch_start = $_POST["saturday_lunch_start"];
$sunday_lunch_start = $_POST["sunday_lunch_start"];

//Lunch end
$monday_lunch_end = $_POST["monday_lunch_end"];
$tuesday_lunch_end = $_POST["tuesday_lunch_end"];
$wednesday_lunch_end = $_POST["wednesday_lunch_end"];
$thursday_lunch_end = $_POST["thursday_lunch_end"];
$friday_lunch_end = $_POST["friday_lunch_end"];
$saturday_lunch_end = $_POST["saturday_lunch_end"];
$sunday_lunch_end = $_POST["sunday_lunch_end"];


if(!empty($_POST['monday_off'])){
	$monday_off="T";
}
else{ $monday_off="F";}

if(!empty($_POST['tuesday_off'])){
	$tuesday_off="T";
}
else{ $tuesday_off="F";}

if(!empty($_POST['wednesday_off'])){
	$wednesday_off="T";;
}
else{ $wednesday_off="F";}

if(!empty($_POST['thursday_off'])){
	$thursday_off="T";
}
else{ $thursday_off="F";}

if(!empty($_POST['friday_off'])){
	$friday_off="T";
}
else{ $friday_off="F";}

if(!empty($_POST['saturday_off'])){
	$saturday_off="T";
}
else{ $saturday_off="F";}

if(!empty($_POST['sunday_off'])){
	$sunday_off="T";
}
else{ $sunday_off="F";}

$update = new Staff;
$update->update_staff__member_working_time($monday_start,$tuesday_start,$wednesday_start,
													$thursday_start,$friday_start,$saturday_start,
													$sunday_start,
													
													$monday_end,$tuesday_end,$wednesday_end,$thursday_end,
													$friday_end,$saturday_end,$sunday_end,
													
													$monday_lunch_start,$tuesday_lunch_start,
													$wednesday_lunch_start,$thursday_lunch_start,$friday_lunch_start,$saturday_lunch_start,
													$sunday_lunch_start,
													
													$monday_lunch_end,$tuesday_lunch_end,
													$wednesday_lunch_end,$thursday_lunch_end,$friday_lunch_end,$saturday_lunch_end,
													$sunday_lunch_end,
													
													$monday_off,$tuesday_off,$wednesday_off,$thursday_off,$friday_off,$saturday_off,$sunday_off,$edit_id);

}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Profile</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../core/assets/js/working_time.js"></script>
</head>
<body onload="work_update()" style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<div class="tab-panel">
    <ul class="nav nav-tabs" id="edit_user_tab">
        <li><a href="edit_user.php"><i class="glyphicon glyphicon-th-list"></i>Details</a></li>
        <li class="active"><a href="working_time.php"><i class="glyphicon glyphicon-time"></i>Working Time</a></li>
        <li><a href="select_service.php"><i class="glyphicon glyphicon-cog"></i>Service</a></li>		
    </ul>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="content">
		<p>Set working time</p>
		<div class="new">
			<button type="submit" name="work_time" class="btn ">
				<span>Save</span>
			</button>
		</div>		
	<hr>	
		<div class="working-time" style="overflow-x:auto;">				
			<?php echo $output; ?>
		</div>
	</div>
	</form>
</div>	
<?php include "../core/elements/footer.php"; ?>	
</body>
</html>
