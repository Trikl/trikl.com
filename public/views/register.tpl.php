
<script type="text/javascript" src="public/js/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
jQuery.validator.setDefaults({
	debug: true,
	success: "valid"
});;
</script>
<script type="text/javascript">
$.validator.addMethod('passreq', function(value, element) {
        return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
    },
    'Must contain one numeric and one alphabetic character.');
</script>
  <script>
  $(document).ready(function(){
    $("#register").validate({
   rules: {
  	  username: {
	    required: true,
	    rangelength: [3, 15],
	  },
	  email: {
      	required: true,
      	email: true

      },
      email_conf: {
      	required: true,
      	equalTo: "#email",
      	email: true
      },
      password: {
	  	required: true,
	  	passreq: true,
	  	rangelength: [7, 15]
	  },
	  password_conf: {
	    required: true,
	    equalTo: "#password"
	  },
	  firstname: {
	    required: true
	  },
	  lastname: {
	    required: true
	  }
   },
   submitHandler: function(form) {
    	form.submit();
        return false;
   },
   messages: {
	   username: {
		   remote: jQuery.format("{0} is already in use")
	   },
	   email: {
		   remote: ("Email is already in use")
	   }
   }   
}
);
	   onkeyup: true;
   onblur:  true;
  });
  </script>

<form id="register" method='post' action="index.php">
	<input class="reg" id="username" placeholder="Username" type='text' name='username' size='30'><br />
	<input class="reg" id="password" placeholder="Password" type='password' name='password' size='30'>
	<input class="reg" id="password_conf" placeholder="Confirm Password" type='password' name='password_conf' size='30'><br />
	<input class="reg" id="email" placeholder="E-Mail" type='text' name='email' size='30'>
	<input class="reg" id="email_conf" placeholder="Confirm E-Mail" type='text' name='email_conf' size='30'><br />
	<input class="reg" id="firstname" placeholder="First Name" type='text' name='firstname' size='30'>
	<input class="reg" id="lastname" placeholder="Last Name" type='text' name='lastname' size='30'><br />
	<input type='submit' name="register" value="Submit">
</form>

