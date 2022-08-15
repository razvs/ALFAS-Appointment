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
$show = new Settings;
$show->get_settings();

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

function getCurrencySymbol($currencyCode, $locale = 'en_US')
{
    $formatter = new \NumberFormatter($locale . '@currency=' . $currencyCode, \NumberFormatter::CURRENCY);
    return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
}

$currency_symbol = getCurrencySymbol($_POST["currencies"]);
$update = new Settings;
$update->update_settings($_POST["start_time"],$_POST["end_time"],$_POST["before_time"],$_POST["after_time"],$_POST["timezone"],$_POST["currencies"],$currency_symbol);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "elements/style.php"; ?>	
    <title>Settings</title>
    <script type="text/javascript" src="../core/assets/js/jquery.min.js"></script>	
</head>
<body style="background-color:#fff !important">
<?php include "../core/elements/header.php"; ?>
<?php include "elements/menu.php"; ?>
<?php include "elements/dashboard.php"; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">		
  <div class="content">
	<p>Settings</p>
		<div class="new">
			<button type="submit" class="btn ">
				<span>Save</span>
			</button>
		</div>
	<hr>
<label class="col-sm-2 control-label">Start Time:</label>
	<div class="col-md-4 form-group">
		<input class="form-control" type="text" name="start_time" value="<?php echo $show->start_time; ?>">
	</div>
<label class="col-sm-2 control-label">End Time:</label>
	<div class="col-md-4 form-group">
		<input class="form-control" type="text" name="end_time" value="<?php echo $show->end_time; ?>">
	</div>	
<label class="col-sm-2 control-label">Before Time:</label>
	<div class="col-md-4 form-group">
		<input class="form-control" type="text" name="before_time" value="<?php echo $show->before_time; ?>">
	</div>
<label class="col-sm-2 control-label">After Time:</label>
	<div class="col-md-4 form-group">
		<input class="form-control" type="text" name="after_time" value="<?php echo $show->after_time; ?>">
	</div>
<label class="col-sm-2 control-label form-group">Timezone:</label>
	<div class="col-sm-4">
<?php
$regions = array(
    'Africa' => DateTimeZone::AFRICA,
    'America' => DateTimeZone::AMERICA,
    'Antarctica' => DateTimeZone::ANTARCTICA,
    'Aisa' => DateTimeZone::ASIA,
    'Atlantic' => DateTimeZone::ATLANTIC,
    'Europe' => DateTimeZone::EUROPE,
    'Indian' => DateTimeZone::INDIAN,
    'Pacific' => DateTimeZone::PACIFIC
);
$timezones = array();
foreach ($regions as $name => $mask)
{
    $zones = DateTimeZone::listIdentifiers($mask);
    foreach($zones as $timezone)
    {
		// Lets sample the time there right now
		$time = new DateTime(NULL, new DateTimeZone($timezone));
		// Us dumb Americans can't handle millitary time
		$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
		// Remove region name and add a sample time
		$timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
	}
}
// Show
echo '<select class="form-control" name="timezone" id="timezone">';
foreach($timezones as $region => $list)
{
	echo '<optgroup label="' . $region . '">' . "\n";
	foreach($list as $timezone => $name)
	{
		echo '<option value="' . $timezone . '" '. (($timezone==$show->timezone)?'selected="selected"':"") .'>' . $name . '</option>' . "\n";
	}
	echo '<optgroup>' . "\n";
}
echo '</select>';
?>
	</div>
<label class="col-sm-2 control-label">Currency:</label>
	<div class="col-md-4 form-group">
		<select class="form-control" name=" currencies">
		<?php	
			$currencies = array("USD", "EUR", "AUD", "BRL", "CAD", "CZK", "DKK", "HKD", "HUF", "JPY", "GBP", "PLN", "CHF");
			foreach($currencies as $curr){
				echo '<option value="' . $curr . '" '. (($curr==$show->currency)?'selected="selected"':"") .'>' . $curr . '</option>' . "\n";
			}
		?>
		</select>
	</div> 	
  </div> 
</form>

<?php include "../core/elements/footer.php"; ?>	
</body>
</html>