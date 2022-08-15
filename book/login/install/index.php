<?php
error_reporting(0);
require_once "../config/install_step.php";
if($step == "0")
{

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

if(empty($_POST["host"])){
	$host_err = "Please enter your hostname";
}else{
	$host = $_POST["host"];	
}

if(empty($_POST["username"])){
	$dbusername_err = "Please enter your username";
}else{
	$dbusername = $_POST["username"];
}

if(empty($_POST["password"])){
	$dbpassword_err = "Please enter your password";
}else{
	$dbpassword = $_POST["password"];
}
		
if(empty($_POST["database"])){
	$dbname_err = "Please enter your database";
}else{
	$dbname = $_POST["database"];
}





	if(!empty($host) && !empty($dbusername) && !empty($dbpassword)){
		$con = mysqli_connect($host, $dbusername, $dbpassword);	

		if(!$con){

		$error_message = "<p style='color:red;'>Wrong MySQL details</p>";
		
	}else{
		//create database
		$sql = "CREATE DATABASE $dbname";
		$run = mysqli_query($con,$sql);
		
		// now try to create file and write information
		$config_file = file_get_contents('config.tpl');
		$config_file = str_replace('<DB_HOST>', $host, $config_file);
		$config_file = str_replace('<DB_NAME>', $dbname, $config_file);
		$config_file = str_replace('<DB_USER>', $dbusername, $config_file);
		$config_file = str_replace('<DB_PASSWORD>', $dbpassword, $config_file);
		$f = fopen('../config/config.php', 'w+');
		fwrite($f, $config_file);
										
		fclose($f);
		if(fwrite){	

		$step = 1;
		$install_step = file_get_contents('install_step.tpl');
		$install_step = str_replace('<step>', $step, $install_step);
		$f = fopen('../config/install_step.php', 'w+');
		fwrite($f, $install_step);							
		fclose($f);
			
			header("location: admin_account.php");
			
		}
			// Close connection
			mysqli_close($con);		
	}	

	}
}	
}elseif($step == "1"){
		header("location: admin_account.php");
}elseif($step == "2" ){
		header("location: done.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../core/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/install.css">	
    <link rel="stylesheet" href="../core/assets/css/bootstrap.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <title>Install</title>
</head>
<body style="padding-left:0px;">
<div class="header">
	<a class="logo">
		<img src="../core/assets/img/logo.png" alt="Alfa Studio">
	</a> 
</div> 
    <div class="wrapper">
	<div class="database">
		<div class="head">
        <p>MySQL Setup</p>
		<hr>
		</div>
	<div class="panel panel col-lg-12">	
        <h4>Database Settings</h4>
        <form name="config_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($host_err)) ? 'has-error' : ''; ?>">
                <label>Host</label>
                <input type="text" name="host" class="form-control">
                <span class="help-block"><?php echo $host_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($dbname_err)) ? 'has-error' : ''; ?>">
                <label>Database</label>
                <input type="text" name="database" class="form-control">
                <span class="help-block"><?php echo $dbname_err; ?></span>
            </div> 			
            <div class="form-group <?php echo (!empty($dbusername_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                <span class="help-block"><?php echo $dbusername_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($dbpassword_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $dbpassword_err; ?></span>
            </div>		
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Next">
            </div>
			<?php echo $error_message; ?>
		</div>	
        </form>
    </div> 
</div>	
<?php include "../core/elements/footer.php"; ?>	
</body>
</html>
