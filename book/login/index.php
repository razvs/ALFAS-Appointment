<?php
if(file_exists("config/config.php")){

	require_once("config/config.php");
	$sql = "SELECT * FROM users";
	$run = mysqli_query($link,$sql);
		if($run)
		{
			header("location: core/login.php");
		}else
			{
				header("location: install/index.php");
			}
}else
	{
		header("location: install/index.php");
	}
?>