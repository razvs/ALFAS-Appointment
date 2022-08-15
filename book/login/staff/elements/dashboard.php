<?php
/* [INIT] */
require "../config/config.php";


// Initialize the session
session_start();
    $id = $_SESSION["id"];	
//Get avatar 
 $sql = "SELECT avatar FROM users WHERE id=$id"; 
$result = $link->query($sql);
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      // Store data in variables
      $avatar = $row['avatar'];
    }
}	
?>
    <link rel="stylesheet" href="elements/assets/css/style.css">
<nav class="navbar" tabindex="0">
	<div class="smartphone-navbar-trigger"></div>
  <header class="avatar">
		<img src="../<?php if(!empty($avatar)){echo $avatar;}else{echo "uploads/img/users/default.png";} ?>" />
  </header>
	<ul>
    <a href="appointments.php"><li tabindex="0" class="icon-appointments"><span>Appointments</span></li></a>
    <a href="services.php"><li tabindex="1" class="icon-services"><span>Services</span></li></a>
    <a href="working_time.php"><li tabindex="2" class="icon-staff"><span>Working Time</span></li></a>
    <a href="settings.php"><li tabindex="4" class="icon-settings"><span>Settings</span></li></a>
  </ul>
</nav>

<script>
	$(document).ready(function () {
		
$("a").each(function() {
    if ((window.location.pathname.indexOf($(this).attr('href'))) > -1) {
        $(this).addClass('activenav');
    }
});


});
</script>
	