<?php
// Include files
require_once "config.php";

//select table
$sql = "SELECT start_time, end_time, before_time, after_time, currency, currency_symbol, timezone FROM settings";
$result = mysqli_query($link, $sql);
$start_time = "";
$end_time = "";
$before_time = "";
$after_time = "";
$timezone = "";
$currency = "";
$currency_symbol = "";

//get row
while ($row = mysqli_fetch_assoc($result))
{
	$start_time = $row["start_time"];
	$end_time = $row["end_time"];	
	$before_time = $row["before_time"];
	$after_time = $row["after_time"];
	$timezone = $row["timezone"];
	$currency = $row["currency"];	
	$currency_symbol = $row["currency_symbol"];
}  

date_default_timezone_set($timezone); 
?>