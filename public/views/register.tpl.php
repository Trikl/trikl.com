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



<style>
.contents {
	margin:0 auto;
	width:223px;
}
.LoginButn {
	height: 192px;
	position:absolute;
}
.error {
	position:absolute;
	width:400px;
	color:#FFF;
	-webkit-border-top-right-radius: 20px;
	-webkit-border-bottom-right-radius: 20px;
	-moz-border-radius-topright: 20px;
	-moz-border-radius-bottomright: 20px;
	border-top-right-radius: 20px;
	border-bottom-right-radius: 20px;
	text-align: center;
	box-shadow: 0 0 7px black;
	background:#000;
	height:22px;
	padding-top:3px;
}
.reg {
	position:relative;
	width:173px;
	color:#000;
	margin-top:0px;
	background:#FFF;
	border-radius:0px;
	text-align:left;
	height:19px;
	padding-top:0px;

}
form {
	margin-left:20px;
	position: absolute;
}
.error.valid {
	opacity:0;
}
</style>

<form id="register" method='post' action="index.php">
	<input class="reg" id="username" placeholder="USERNAME" type='text' name='username' size='30'><br />
	<input class="reg" id="password" placeholder="PASSWORD" type='password' name='password' size='30'><br />
	<input class="reg" id="password_conf" placeholder="CONFIRM PASSWORD" type='password' name='password_conf' size='30'><br />
	<input class="reg" id="email" placeholder="EMAIL" type='text' name='email' size='30'><br />
	<input class="reg" id="email_conf" placeholder="CONFIRM EMAIL" type='text' name='email_conf' size='30'><br />
	<input class="reg" id="firstname" placeholder="FIRST NAME" type='text' name='firstname' size='30'><br />
	<input class="reg" id="lastname" placeholder="LAST NAME" type='text' name='lastname' size='30'><br />
	<input type='submit' name="register" value="Submit">
	<input type="submit" value="< Back" class="back" >

</form>
