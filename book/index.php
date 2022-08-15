<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>	
    <link rel="stylesheet" href="login/core/assets/css/bootstrap.min.css">	
    <link rel="stylesheet" href="frontend/assets/css/style.css">	
    <link rel="stylesheet" href="frontend/assets/css/normalize.css">	
  </head>
  <body> 
	<div id="load"></div>

<script type="text/javascript" src="login/core/assets/js/jquery.min.js"></script>
<script>
$(document).ready(function () {
$("#load").load('frontend/index.php');
});
</script>
	
</body>
</html>  
<?php
	require "login/config/config.php";
if($link === false){
    		header("location: login/install/index.php");
}
?>
