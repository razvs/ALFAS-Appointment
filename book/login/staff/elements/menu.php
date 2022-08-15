<?php
/* [INIT] */
require "../config/config.php";


// Initialize the session
session_start();
    $id = $_SESSION["id"];	
//Get avatar 
 $sql = "SELECT firstname FROM users WHERE id=$id"; 
$result = $link->query($sql);
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      // Store data in variables
	  $wellcomename = $row['firstname'];
    }
}	
?>
<div class="menu">
<ul>
  <li style="float:left; color:#fff;">Welcome, <?php echo $wellcomename; ?></li>
  <a href="profile.php"><li class="icon-profile">Profile</li></a>
  <a href="../core/logout.php"><li class="icon-logout">Logout</li></a>  
</ul>
</div>
