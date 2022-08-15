$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".add_duration");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><div class="field"><label>Minutes</label><input type="text"  name="duration_add[]" placeholder="0" required onkeypress="return isNumberKey(event)"/></div><div class="field"><label>Price</label><input type="text" name="price_add[]" placeholder="Price" required onkeypress="return isNumberKey(event)"/></div><button type="button" class="btn delete" style="background-color:red; color:#fff;"><span class="glyphicon glyphicon-remove" style="font-size:14px; "></span></button></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;

    })
	
	
});