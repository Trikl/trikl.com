<form id="registeruser" method='post' action="index.php">
	<input class="reg" id="username" placeholder="username" type='text' name='username' size='30'><br /> <div id="errorcontainer-username" class='errorDiv'></div>
	<input class="reg" id="password" placeholder="password" type='password' name='password' size='30'><br /> <span id="errorcontainer-password" class='errorDiv'></span>
	<input class="reg" id="password_conf" placeholder="confirm password" type='password' name='password_conf' size='30'><br /> <span id="errorcontainer-password_conf" class='errorDiv'></span>
	<input class="reg" id="email" placeholder="e-mail" type='text' name='email' size='30'> <span id="errorcontainer-email" class='errorDiv'></span>
	<input class="reg" id="email_conf" placeholder="confirm e-mail" type='text' name='email_conf' size='30'><br /> <span id="errorcontainer-email_conf" class='errorDiv'></span>
	<input class="reg" id="firstname" placeholder="first name" type='text' name='firstname' size='30'> <span id="errorcontainer-firstname" class='errorDiv'></span>
	<input class="reg" id="lastname" placeholder="last name" type='text' name='lastname' size='30'><br /> <span id="errorcontainer-lastname" class='errorDiv'></span>
	<input class="submit" type='submit' name="register" value="register">
</form>

<script>
		$("#lastname").on("keyup", function() {
			var postdata = $(this).val().length;
			thingsandstuff(postdata);
		});

		formvalidation();
</script>
