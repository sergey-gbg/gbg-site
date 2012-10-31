<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<!-- ### Stylesheet ### -->
<link rel="stylesheet" type="text/css" href="/style/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />

<html>

<body id="contact_form">
	
	<script type="text/javascript">
	
		function clear_color() {
			document.forms["contactform"]["name"].style.background = "white";
			document.forms["contactform"]["email"].style.background = "white";
			document.forms["contactform"]["message"].style.background = "white";
		}
	
		function validateForm() {
			var x=document.forms["contactform"]["email"].value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			var name=document.forms["contactform"]["name"].value;
			var message=document.forms["contactform"]["message"].value;
			
			if (name==null || name=="") {
				document.forms["contactform"]["name"].style.background = "pink";
  				alert("Please provide a name.");
  				return false;
  			} else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length || x.indexOf(" ")!=-1) {
				document.forms["contactform"]["email"].style.background = "pink";
				alert("Please check your email address for errors.");
				return false;
			} else if (message==null || message.length<5) {
				document.forms["contactform"]["message"].style.background = "pink";
  				alert("Please include a message.");
  				return false;
  			}
		}	
	
	</script>
		
	
<form name="contactform" id="contactform" method="post" action="/jquery/email_form.php" onsubmit="return validateForm();">
<div class="contact_pop">
  <br/>

  <label for="name">Name: *</label> 
  <input  type="text" name="name" maxlength="50" size="30" onClick="clear_color();"
  <br/>
 
 
  <label for="email">Email Address: *</label> 
  <input  type="text" name="email" maxlength="80" size="30" onclick="clear_color();">
  <br/>
 

  <label for="telephone">Phone Number:</label> 
  <input  type="text" name="telephone" maxlength="30" size="15">
  <br/>

  <label for="comments">Message: *</label> 
  <textarea  name="message" maxlength="1000" cols="40" rows="6" onclick="clear_color();"></textarea>
  <br/>
 
 
  <input class="contact_button" name="submit" type="submit" value="Submit">  
  
  <!--<p id="error">There were errors on the form, please make sure all fields are fill out correctly.</p>-->

</div>
</form>

	<!--
	<script type="text/javascript">
	
	$("#SubmitButton").click(function () {
	
	// Place ID's of all required fields here.
	required = ["name", "email", "message"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email");
	errornotice = $("#error");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";

	//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
			}
		}
		
		// Validate the e-mail.
		if (!/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
    			email.addClass("needsfilled");
    			email.val(emailerror);
		}
		
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if ($(":input").hasClass("needsfilled")) {
			return false;
		} else {
			errornotice.hide();
			return true;
		}
	});
	
	<script type="text/javascript">
	$(document).ready(function(){
	
	// Place ID's of all required fields here.
	required = ["name", "email", "message"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email");
	errornotice = $("#error");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	
	$("#contactform").submit(function(){
		//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
			}
		}
		
		// Validate the e-mail.
		if (!/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
    			email.addClass("needsfilled");
    			email.val(emailerror);
		}
		
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if ($(":input").hasClass("needsfilled")) {
			return false;
		} else {
			errornotice.hide();
			return true;
		}
		
		// Clears any fields in the form when the user clicks on them
		$(":input").focus(function(){
  			if ($(this).hasClass("needsfilled") ) {
				$(this).val("");
				$(this).removeClass("needsfilled");
   			}
   		});
	});	
	</script>
	-->

</body>
</html>