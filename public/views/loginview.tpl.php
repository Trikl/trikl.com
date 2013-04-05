	<div class="LoginButn">
		<form method='post'>
			<input placeholder="username" type='text' name='username' size='31'>
			<input id="password" placeholder="password" type='password' name='password' size='31'><br />
			<div class="remember">
			<input type="checkbox" name="age" id="customerAge"><span>remember me</span><br />
			</div>
			<input class="submit" type='submit' value='login' name='login'>
		</form>
	</div>
	
	
<script>
$('input[type="checkbox"]').ezMark();

		$("#password").on("keyup", function() {
		
			var postdata = $(this).val().length;
			thingsandstuff(postdata);
		});
</script>
	
	