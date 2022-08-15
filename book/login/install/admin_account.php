<?php
require_once "../config/install_step.php";
if($step == "1")
{

// Include config file
require_once "../config/config.php";


// sql to create table
$sql = file_get_contents('database.sql');

$run = mysqli_multi_query($link,$sql);

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 
// Define variables and initialize with empty values
$username  = $password = $confirm_password = $email = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

 
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate email address
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your Email Addres.";     
    }
	    $email = input($_POST["email"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    } else{
        $email = trim($_POST["email"]);
    } 
	
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err && empty($email_err))){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password, isadmin) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $admin);
            
            // Set parameters
            $param_username = $username;
			$param_email = $email;
			$admin = "1";
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				
				$step = 2;
				$install_step = file_get_contents('install_step.tpl');
				$install_step = str_replace('<step>', $step, $install_step);
				$f = fopen('../config/install_step.php', 'w+');
				fwrite($f, $install_step);							
				fclose($f);				
                // Redirect to login page
                header("location: done.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
	
}elseif($step == "0"){
	header("location: index.php");
}elseif($step == "2"){
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
    <title>Login</title>
</head>
<body style="padding-left:0px;">
<div class="header">
	<a class="logo">
		<img src="../core/assets/img/logo.png" alt="Alfa Studio">
	</a> 
</div>
    <div class="wrapper">
		<div class="panel col-lg-12">
        <h2>Admin Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
	</div>
   </div>
<?php include "../core/elements/footer.php"; ?>	    
</body>
</html>