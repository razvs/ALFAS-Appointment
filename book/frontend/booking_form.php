
    <div class="container" id="secondc">
    <div class="well form-horizontal"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>Your Details</b></h2></center></legend><br>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">First Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="firstname" placeholder="First Name" class="form-control"  type="text" required>
    </div>
	  <span class="text-danger"><p id="firstname_err"></p></span>	
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Last Name</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="lastname" placeholder="Last Name" class="form-control"  type="text" required>
    </div>
	  <span class="text-danger"><p id="lastname_err"></span>	
  </div>
</div>

  
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Postcode</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
  <input  name="postcode" placeholder="Postcode" class="form-control"  type="text" required>
    </div>
	  <span class="text-danger"><p id="postcode_err"></span>	
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Address</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
  <input name="address" placeholder="Address" class="form-control"  type="text" required>
    </div>
	  <span class="text-danger"><p id="address_err"></span>	
  </div>
</div>



<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" required>
    </div>
	  <span class="text-danger"><p id="email_err"></span>	
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Contact No.</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="phone" placeholder="+36" class="form-control" type="text" required>
    </div>
	  <span class="text-danger"><p id="phone_err"></span>
  </div>
</div>

<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Message</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <textarea name="message" class="form-control" ></textarea>
    </div>
  </div>
</div>

<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">PayBy</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
    <div class="form_radio">
        <div class="form_radio-primary">
            <input type="radio" name="payby" id="radio1" value="Cash" checked />
            <label for="radio1">Cash &nbsp </label>
        </div>
        <div class="form_radio-primary">
            <input type="radio" name="payby" value="Card" id="radio2" />
            <label for="radio2">Card &nbsp </label>
        </div>
    </div>
    </div>
  </div>
</div>
	
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    <button type="submit" name="submit" id="insertbooking" class="btn btn-warning" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>

</fieldset>
</div>
</div>
<!-- partial -->
<script type="text/javascript" src="frontend/assets/js/booking-control.js"></script>
