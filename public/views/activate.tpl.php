<?php include TPL.'header.tpl.php'; ?>

<h1>Activate</h1>

<form method='post'>
	Activation code: <input type='text' name='activatecode' size='30'><br>
	<input type='hidden' name='date' value='$date'>
	<input type='submit' value='Activate'>
</form>
