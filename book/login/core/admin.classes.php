<?php

//Foglalások
class Appointments{
	 private $sql,$result,$row;
	public function get_appointments(){
		include "../config/config.php";
		//Get appointments 
		$this->sql = "SELECT id, firstname, lastname, email, phone_number, amount, selected_date, selected_time, selected_service, selected_therapist, status FROM appointments ORDER BY id DESC"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id [] = $this->row['id'];
			  $this->firstname [] = $this->row['firstname'];		  
			  $this->lastname [] = $this->row['lastname'];
			  $this->email [] = $this->row['email'];
			  $this->phone_number [] = $this->row['phone_number'];
			  $this->amount [] = $this->row['amount'];
			  $this->selected_date [] = $this->row['selected_date'];
			  $this->time = strtotime($this->row['selected_time']);
			  $this->selected_time [] = date('H:i', $this->time);
			  $this->selected_service [] = $this->row['selected_service'];
			  $this->selected_therapist [] = $this->row['selected_therapist'];
			  $this->status [] = $this->row['status'];
			}
		}		
	}
	
	public function get_appointment($app_id){
		include "../config/config.php";
		//Get appointment
		$this->sql = "SELECT id, firstname, lastname, email, 
		phone_number, post_code, address, selected_therapist, 
		selected_therapist_id, selected_service, selected_duration, 
		selected_type, selected_date, selected_time, message, payby, 
		amount, status, created_at FROM appointments WHERE id = $app_id"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id = $this->row['id'];
			  $this->firstname = $this->row['firstname'];		  
			  $this->lastname = $this->row['lastname'];
			  $this->email = $this->row['email'];
			  $this->phone_number = $this->row['phone_number'];
			  $this->post_code = $this->row['post_code'];
			  $this->address = $this->row['address'];
			  $this->selected_therapist = $this->row['selected_therapist'];
			  $this->selected_therapist_id = $this->row['selected_therapist_id'];
			  $this->selected_service = $this->row['selected_service'];
			  $this->selected_duration = $this->row['selected_duration'];
			  $this->selected_type = $this->row['selected_type'];
			  $this->selected_date = $this->row['selected_date'];
			  $this->time = strtotime($this->row['selected_time']);
			  $this->selected_time = date('H:i', $this->time);
			  $this->message = $this->row['message'];  
			  $this->payby = $this->row['payby'];
			  $this->amount = $this->row['amount'];
			  $this->status  = $this->row['status'];
			  $this->created_at  = $this->row['created_at'];
			}
		}		
	}	
}

//Szolgáltatások
class services{
	 private $sql,$result,$row;
	public function get_services(){
		include "../config/config.php";
		//Get services
		$this->sql = "SELECT id, service_name, service_desc, service_img, isactive FROM services"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id [] = $this->row['id'];
			  $this->service_name [] = $this->row['service_name'];		  
			  $this->service_desc [] = $this->row['service_desc'];
			  $this->service_img [] = $this->row['service_img'];
			  $this->isactive [] = $this->row['isactive'];
			}
		}		
	}

	public function insert_service($name,$desc,$img,$duration,$price){
		include "../config/config.php";
		//select all user instead of admin
		$this->sql = "SELECT id FROM users WHERE isadmin !=1";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $users [] = $this->row['id'];				
			}
		}
		
		//Insert into services
		$this->sql = "INSERT INTO services (service_name, service_desc, service_img, isactive)
					VALUES ('$name', '$desc', '$img', '1')"; 
			// run insert query
			$this->result = $link->query($this->sql);
			$last_id = $link->insert_id;

		foreach($duration as $index => $value)
		{
		
			// insert query
			$this->sql = "INSERT INTO services_duration (service_id, service_name, duration, price)
			VALUES ('$last_id', '$name', '$value', '$price[$index]')";
		
			// run insert query
			$this->result = $link->query($this->sql);
			$last_id2 = $link->insert_id;
			foreach($users as $ids)
			{
			// insert query
			$this->sql = "INSERT INTO users_services (user_id, services_duration_id, service_id, isactive)
			VALUES ('$ids', '$last_id2', '$last_id', '1')";
			// run insert query
			$this->result = $link->query($this->sql);				
			}
		}
		if($link->query($this->sql) === TRUE)
		{
			header( "location:services.php");
		}else
		{
			echo "Error updating record: " . $link->error;
		}		
	}
	
	public function edit_service($id){
		include "../config/config.php";
		//Get service
		$this->sql = "SELECT service_name, service_desc, service_img FROM services WHERE id = $id";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->service_name = $this->row['service_name'];
			  $this->service_desc = $this->row['service_desc'];		  
			  $this->service_img = $this->row['service_img'];
			}
		}	
		$this->sql = "SELECT id, duration, price FROM services_duration WHERE service_id = $id";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id [] = $this->row['id'];
			  $this->price [] = $this->row['price'];		  
			  $this->duration [] = $this->row['duration'];
			}
		}	
	}
	
	public function update_service($id,$name,$desc,$img){
		include "../config/config.php";
		//update service name,desc,img
		$this->sql = "UPDATE services SET service_name='$name', service_desc='$desc', service_img='$img' WHERE id = $id";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:edit_service.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}

	public function update_duration($id,$name,$duration,$price){
		include "../config/config.php";
		//update service durations
			$this->sql = "SELECT id FROM services_duration WHERE service_id = $id";
			$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $ids [] = $this->row['id'];				
			}
		}	
		foreach($duration as $index => $value)
		{
			// query to update element
			$this->sql = "UPDATE services_duration SET service_name='$name', duration='$value', price='$price[$index]' WHERE id = $ids[$index]";
				
			if($link->query($this->sql) === TRUE)
			{
				header( "location:edit_service.php");
			}else
			{
				echo "Error updating record: " . $link->error;
			}				
		}		
	
	}

	public function add_duration($id,$name,$duration,$price){
		
		include "../config/config.php";
		//select all user instead of admin
		$this->sql = "SELECT id FROM users WHERE isadmin !=1";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $users [] = $this->row['id'];				
			}
		}		
		//add duration
		foreach($duration as $index => $value)
		{
			$this->sql = "INSERT INTO services_duration (service_id, service_name, duration, price)
			VALUES ('$id', '$name', '$value', '$price[$index]')";
			// run insert query
			$this->result = $link->query($this->sql);
			$last_id = $link->insert_id;
			foreach($users as $value)
			{
				// run insert query
				$this->sql = "INSERT INTO users_services (user_id, services_duration_id, service_id, isactive)
				VALUES ('$value', '$last_id', '$id', '1')";
				$this->result = $link->query($this->sql);				
			}			
		}		
	}

	public function delete_duration($id){
		include "../config/config.php";
		//Delete duration
		$this->sql = "DELETE services_duration, users_services
					FROM   services_duration
					JOIN   users_services ON (users_services.services_duration_id = services_duration.id)
					WHERE  services_duration.id = $id";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:edit_service.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}
	
	public function delete_service($id){
		include "../config/config.php";
		//Delete service
		$this->sql = "DELETE services, services_duration, users_services
					FROM   services
					JOIN   services_duration ON (services_duration.service_id = services.id)
					JOIN   users_services ON (users_services.service_id = services_duration.service_id)
					WHERE  services.id = $id";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:services.php");
		}else
		{
			echo "Error deleting record: " . $link->error;
		}		
	}

	public function select_services($id){
		include "../config/config.php";
		//get services
		$this->sql = "SELECT id, service_id, service_name, duration, price FROM services_duration ORDER BY service_id";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id [] = $this->row['id'];
			  $this->service_id [] = $this->row['service_id'];		  
			  $this->service_name [] = $this->row['service_name'];
			  $this->duration [] = $this->row['duration'];
			  $this->price [] = $this->row['price'];
			}
		}
		//get duration
		$this->sql = "SELECT services_duration_id, isactive FROM users_services WHERE user_id = '$id'";
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->services_duration_id [] = $this->row['services_duration_id'];
			  $this->isactive [] = $this->row['isactive'];
			}
		}		
	}
}

//Ügyfelek
class Clients{
	 private $sql,$result,$row;
	public function get_clients(){
		include "../config/config.php";
		//Get clients
		$this->sql = "SELECT email, firstname, lastname, mobile_number FROM clients ORDER BY id DESC"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->email [] = $this->row['email'];
			  $this->firstname [] = $this->row['firstname'];		  
			  $this->lastname [] = $this->row['lastname'];
			  $this->mobile_number [] = $this->row['mobile_number'];
			}
		}		
	}
	
	public function insert_client($email,$firstname,$lastname,$mobile){
		include "../config/config.php";
		//Insert client
		$this->sql = "SELECT email FROM clients WHERE email = '$email'";
		$this->result = $link->query($this->sql);			
			if($this->result->num_rows == 0) 
			{
				// insert client if doesn't exist
				$this->sql = "INSERT INTO clients (email, firstname, lastname, mobile_number) 
							VALUES ('$email', '$firstname', '$lastname', '$mobile')";
				
					if($link->query($this->sql) === TRUE)
					{
						header( "location:client.php");					
					}else
					{
						echo "Error inserting record: " . $link->error;
					}				
			}else{
				$this->output = "<div class='alert alert-warning'>";
				$this->output .= "<strong>Warning!</strong> This Email Address is exist.";
				$this->output .= "</div>";
			}		
	}	
}

//Beállítások
class Settings{
	 private $sql,$result,$row;
	public function get_settings(){
		include "../config/config.php";
		//Get settings
		$this->sql = "SELECT start_time, end_time, before_time, after_time, timezone, currency FROM settings"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->start_time = $this->row['start_time'];
			  $this->end_time = $this->row['end_time'];		  
			  $this->before_time = $this->row['before_time'];
			  $this->after_time = $this->row['after_time'];
			  $this->timezone = $this->row['timezone'];
			  $this->currency = $this->row['currency'];
			}
		}		
	}
	
	public function update_settings($start_time,$end_time,$before_time,$after_time,$timezone,$currency,$currency_symbol){
		include "../config/config.php";
		//update settings
		$this->sql = "UPDATE settings SET start_time = '$start_time', end_time = '$end_time', before_time = '$before_time', 
		after_time = '$after_time', timezone = '$timezone', currency = '$currency', currency_symbol = '$currency_symbol'";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:settings.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}	
}

//Profil
class Profile{
	 private $sql,$result,$row;
	public function get_profile($id){
		include "../config/config.php";
		//Get profile
		$this->sql = "SELECT avatar, aboutme, email, firstname, lastname, mobile_number FROM users WHERE id = '$id'"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->avatar = $this->row['avatar'];
			  $this->aboutme = $this->row['aboutme'];		  
			  $this->email = $this->row['email'];
			  $this->firstname = $this->row['firstname'];
			  $this->lastname = $this->row['lastname'];
			  $this->mobile_number = $this->row['mobile_number'];
			}
		}		
	}
	
	public function update_profile($id,$profile_img,$firstname,$lastname,$email,$mobile_number,$aboutme){
		include "../config/config.php";
		//update profile
		$this->sql = "UPDATE users SET avatar='$profile_img', firstname='$firstname', aboutme='$aboutme', 
					lastname='$lastname', email='$email', mobile_number='$mobile_number' WHERE id='$id'";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:profile.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}
	
	public function update_profile_pw($id,$pw){

		include "../config/config.php";
		//update profile password
		$this->sql = "UPDATE users SET password = '$pw' WHERE id = '$id'";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:profile.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}	
}

//Személyzet
class Staff{
	 private $sql,$result,$row;
	public function get_staff(){
		include "../config/config.php";
		//Get staff members
		$this->sql = "SELECT id, firstname, lastname, avatar, isactive, isadmin FROM users WHERE isadmin != 1"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id [] = $this->row['id'];
			  $this->firstname [] = $this->row['firstname'];		  
			  $this->lastname [] = $this->row['lastname'];
			  $this->avatar [] = $this->row['avatar'];
			  $this->isactive [] = $this->row['isactive'];
			  $this->isadmin [] = $this->row['isadmin'];
			}
		}		
	}

	public function get_staff_member($id){
		include "../config/config.php";
		//Get staff members
		$this->sql = "SELECT id, avatar, firstname, lastname, email, mobile_number, aboutme FROM users WHERE id=$id"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
			  $this->id = $this->row['id'];
			  $this->avatar = $this->row['avatar'];			  
			  $this->firstname = $this->row['firstname'];		  
			  $this->lastname = $this->row['lastname'];
			  $this->email = $this->row['email'];
			  $this->mobile_number = $this->row['mobile_number'];
			  $this->aboutme = $this->row['aboutme'];
			}
		}		
	}	
	public function update_staff_member($id,$profile_img,$firstname,$lastname,$email,$mobile_number,$aboutme){
		include "../config/config.php";
		//update staff member details
		$this->sql = "UPDATE users SET avatar='$profile_img', firstname='$firstname', aboutme='$aboutme', 
					lastname='$lastname', email='$email', mobile_number='$mobile_number' WHERE id='$id'";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:edit_user.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}
	
	public function update_staff_member_pw($id,$pw){

		include "../config/config.php";
		//update staff member password
		$this->sql = "UPDATE users SET password = '$pw' WHERE id = '$id'";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:profile.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}

	public function get_staff_working_time($id){
		include "../config/config.php";
		//Get staff member working time
		$this->sql = "SELECT `id`, `user_id`, `type`, `monday_from`, `monday_to`, 
		`monday_lunch_from`, `monday_lunch_to`, `monday_dayoff`, `tuesday_from`, 
		`tuesday_to`, `tuesday_lunch_from`, `tuesday_lunch_to`, `tuesday_dayoff`, 
		`wednesday_from`, `wednesday_to`, `wednesday_lunch_from`, `wednesday_lunch_to`, 
		`wednesday_dayoff`, `thursday_from`, `thursday_to`, `thursday_lunch_from`, `thursday_lunch_to`, 
		`thursday_dayoff`, `friday_from`, `friday_to`, `friday_lunch_from`, `friday_lunch_to`, 
		`friday_dayoff`, `saturday_from`, `saturday_to`, `saturday_lunch_from`, `saturday_lunch_to`, 
		`saturday_dayoff`, `sunday_from`, `sunday_to`, `sunday_lunch_from`, `sunday_lunch_to`, `sunday_dayoff` FROM working_times WHERE user_id = $id"; 
		$this->result = $link->query($this->sql);
		if($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
								
			  $this->id = substr_replace($this->row['id'],"",-3);
			  $this->user_id = substr_replace($this->row['user_id'],"",-3);			  
			  $this->type = substr_replace($this->row['type'],"",-3);
				//Monday
			  $this->monday_from = substr_replace($this->row['monday_from'],"",-3);
			  $this->monday_to = substr_replace($this->row['monday_to'],"",-3);
			  $this->monday_lunch_from = substr_replace($this->row['monday_lunch_from'],"",-3);
			  $this->monday_lunch_to = substr_replace($this->row['monday_lunch_to'],"",-3);
			  $this->monday_dayoff = $this->row['monday_dayoff'];
				//Tuesday
			  $this->tuesday_from = substr_replace($this->row['tuesday_from'],"",-3);
			  $this->tuesday_to = substr_replace($this->row['tuesday_to'],"",-3);
			  $this->tuesday_lunch_from = substr_replace($this->row['tuesday_lunch_from'],"",-3);
			  $this->tuesday_lunch_to = substr_replace($this->row['tuesday_lunch_to'],"",-3);
			  $this->tuesday_dayoff = $this->row['tuesday_dayoff'];
			  	//Wednesday
			  $this->wednesday_from = substr_replace($this->row['wednesday_from'],"",-3);
			  $this->wednesday_to = substr_replace($this->row['wednesday_to'],"",-3);
			  $this->wednesday_lunch_from = substr_replace($this->row['wednesday_lunch_from'],"",-3);
			  $this->wednesday_lunch_to = substr_replace($this->row['wednesday_lunch_to'],"",-3);
			  $this->wednesday_dayoff = $this->row['wednesday_dayoff'];
				//Thursday
			  $this->thursday_from = substr_replace($this->row['thursday_from'],"",-3);
			  $this->thursday_to = substr_replace($this->row['thursday_to'],"",-3);
			  $this->thursday_lunch_from = substr_replace($this->row['thursday_lunch_from'],"",-3);
			  $this->thursday_lunch_to = substr_replace($this->row['thursday_lunch_to'],"",-3);
			  $this->thursday_dayoff = $this->row['thursday_dayoff'];
				//Friday
			  $this->friday_from = substr_replace($this->row['friday_from'],"",-3);
			  $this->friday_to = substr_replace($this->row['friday_to'],"",-3);
			  $this->friday_lunch_from = substr_replace($this->row['friday_lunch_from'],"",-3);
			  $this->friday_lunch_to = substr_replace($this->row['friday_lunch_to'],"",-3);
			  $this->friday_dayoff = $this->row['friday_dayoff'];
				//Saturday
			  $this->saturday_from = substr_replace($this->row['saturday_from'],"",-3);
			  $this->saturday_to = substr_replace($this->row['saturday_to'],"",-3);
			  $this->saturday_lunch_from = substr_replace($this->row['saturday_lunch_from'],"",-3);
			  $this->saturday_lunch_to = substr_replace($this->row['saturday_lunch_to'],"",-3);
			  $this->saturday_dayoff = $this->row['saturday_dayoff'];
				//Sunday
			  $this->sunday_from = substr_replace($this->row['sunday_from'],"",-3);
			  $this->sunday_to = substr_replace($this->row['sunday_to'],"",-3);
			  $this->sunday_lunch_from = substr_replace($this->row['sunday_lunch_from'],"",-3);
			  $this->sunday_lunch_to = substr_replace($this->row['sunday_lunch_to'],"",-3);
			  $this->sunday_dayoff = $this->row['sunday_dayoff'];
			  			  			  			  			  			  
			}
		}		
	}
	
	public function update_staff__member_working_time(
		//Days start time
		$monday_start,$tuesday_start,$wednesday_start,
		$thursday_start,$friday_start,$saturday_start,
		$sunday_start,
		//Days end time
		$monday_end,$tuesday_end,$wednesday_end,$thursday_end,
		$friday_end,$saturday_end,$sunday_end,
		//Days lunch start time
		$monday_lunch_start,$tuesday_lunch_start,
		$wednesday_lunch_start,$thursday_lunch_start,$friday_lunch_start,$saturday_lunch_start,
		$sunday_lunch_start,
		//Days lunch end time
		$monday_lunch_end,$tuesday_lunch_end,
		$wednesday_lunch_end,$thursday_lunch_end,$friday_lunch_end,$saturday_lunch_end,
		$sunday_lunch_end,
		//Days day off
		$monday_off,$tuesday_off,$wednesday_off,$thursday_off,$friday_off,$saturday_off,$sunday_off,$edit_id){

		include "../config/config.php";
		//update staff member working time
		$this->sql = "UPDATE working_times SET monday_from = '$monday_start', tuesday_from = '$tuesday_start', 
		wednesday_from = '$wednesday_start', thursday_from = '$thursday_start', friday_from = '$friday_start', 
		saturday_from = '$saturday_start', sunday_from = '$sunday_start', 
		
		monday_to = '$monday_end', tuesday_to = '$tuesday_end', wednesday_to = '$wednesday_end', thursday_to = '$thursday_end', 
		friday_to = '$friday_end', saturday_to = '$saturday_end', sunday_to = '$sunday_end',
		
		monday_lunch_from = '$monday_lunch_start', tuesday_lunch_from = '$tuesday_lunch_start', 
		wednesday_lunch_from = '$wednesday_lunch_start', thursday_lunch_from = '$thursday_lunch_start', 
		friday_lunch_from = '$friday_lunch_start', saturday_lunch_from = '$saturday_lunch_start', 
		sunday_lunch_from = '$sunday_lunch_start', 
		
		monday_lunch_to = '$monday_lunch_end', tuesday_lunch_to = '$tuesday_lunch_end', 
		wednesday_lunch_to = '$wednesday_lunch_end', thursday_lunch_to = '$thursday_lunch_end', friday_lunch_to = '$friday_lunch_end', 
		saturday_lunch_to = '$saturday_lunch_end', sunday_lunch_to = '$sunday_lunch_end', 
		
		monday_dayoff = '$monday_off', 
		tuesday_dayoff = '$tuesday_off', wednesday_dayoff = '$wednesday_off', thursday_dayoff = '$thursday_off', friday_dayoff = '$friday_off', 
		saturday_dayoff = '$saturday_off', sunday_dayoff = '$sunday_off' WHERE user_id = $edit_id";
		if($link->query($this->sql) === TRUE)
		{
			header( "location:working_time.php");
		}else
		{
			echo "Error updating record:" . $link->error;
		}		
	}	
}

?>