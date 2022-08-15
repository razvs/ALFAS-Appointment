<?php
// Initialize the session
session_start();
    $id = $_SESSION["id"];	
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && $_SESSION["isadmin"] != 1){
    header("location: ../core/login.php");
    exit;
}

// Include files
include "../core/admin.classes.php";
$show = new Clients;
$show->get_clients();

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$insert = new Clients;
	$insert->insert_client($_POST["email"],$_POST["firstname"],$_POST["lastname"],$_POST["mobile"]);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Client</title>
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
  <div class="content">
	<p>Client</p>
		<div class="new">
			<button id="newclient" type="button" class="btn ">
				<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
			</button>
		</div>
	<hr>
<?php echo $insert->output; ?>
<input type="text" id="client_input" onkeyup="data_search()" placeholder="Search for names.." title="Type in a name">
<div style="overflow:auto;">
<table id="client_table">
  <tr class="header">
    <th style="width:40%;">Name</th>
    <th style="width:40%;">Email</th>	
    <th style="width:40%;">Mobile</th>			
  </tr>
<?php
if($show->firstname != NULL){
foreach($show->firstname as $index => $value){
  $output = "<tr>";
    $output .= "<td>".$value." ".$show->lastname[$index]."</td>";
    $output .= "<td>".$show->email[$index]."</td>";
    $output .= "<td>".$show->mobile_number[$index]."</td>";
  $output .= "</tr>";
  echo $output;  
}  
}
?>  
</table>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
		<div class="form" >
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First name</label>
                <input type="text" name="firstname" required>
            </div>    
            <div class="form-group">
                <label>Last name</label>
                <input type="text" name="lastname">
            </div>
            <div class="form-group ">
                <label>Email</label>
                <input type="mail" name="email" required>
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" name="mobile" required>
            </div>		
            <div class="form-group" style="text-align: right;">
				<button type="submit" class="btn btn-primary" style="background-color: #181841;border-color: #181841;">Save</button>
            </div>
        </form>
		</div>
  </div>
</div>	
</div>
<script>
function data_search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("client_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("client_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("newclient");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php include "../core/elements/footer.php"; ?>	
</body>
</html>