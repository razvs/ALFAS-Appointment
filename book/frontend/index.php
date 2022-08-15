<?php 
	require "../login/config/config.php";
	session_start();	
?>

  <div id="form"></div>
	<div class="container bg" id="firstc">
		<div class="row month">
			<div id="selected_month"></div>
			<div class="container-month">
			<nav id="container-month">
				<div id="btn-nav-month-previous"></div>
				<div id="btn-nav-month-next"></div>  
					<div class="inner-box-month">
						<div class="data-month">                        
							<div id="append-month"></div>
						</div>
					</div>        
			</nav>
			</div>
		</div>
		<div class="row">
			<div class="container-time">
				<nav id="container-time">
					<div id="btn-nav-time-previous"></div>
					<div id="btn-nav-time-next" style="display:none"></div>  
						<div class="inner-box-time">
							<div class="data-time">			
								<div id="loadtime"></div>
						</div>
					</div>        
				</nav> 				
			</div>						
		</div>
		<div class="row">
			<div class="services">
				<p>Select service</p>
				<hr>				
					<?php include('show_services.php'); ?>
			</div>	
		</div>
		<div class="row">
			<div class="ppb">
				<p>People per booking</p>
				<hr>	
					<div class="box">				
						<button type="button" class="type active" value="Single">Single</button>
							<p>1 therapist/person</p>
							</div>
							<div class="box">
						<button type="button" class="type" value="Couple">Couple</button>
							<p>2 therapist/2 person</p>
							</div>
							<div class="box">
						<button type="button" class="type" value="Special">Special</button>
					<p>2 therapist/person</p>
				</div>	
			</div>	
		</div>
		<div class="row">
			<div class="durations">
				<p>Select duration</p>
				<hr>				
					<div id="loadduration"></div>
			</div>	
		</div>
		<div class="row">
			<div class="therapists">
				<p>Select Therapist</p>
				<hr>				
					<div id="loadtherapists"></div>
			</div>	
		</div>
		<div class="row">
			<div class="bookingconfirmation">
				<p>Booking Confirmation</p>
				<hr>
				<div class="box">				
					<textarea class="form-control" id="selected-service">
					</textarea>
						<div id="confirmbutton">
						</div>
					<p id="therapist-warning"></p>
				</div>
			</div>	
		</div>		
		</div>
	</div>
<script type="text/javascript" src="frontend/assets/js/calendar.js"></script>
<script type="text/javascript" src="frontend/assets/js/nav-scroll.js"></script>
<script type="text/javascript" src="frontend/assets/js/section-control.js"></script>
<?php mysqli_close($link); ?>