<div class='profile'>
	<h2>Sign Up</h2>

	<form method='POST' action='/users/p_signup'>

		First name *<br> <input type='text' name='first_name' size=50 required autofocus><br>
		Last name *<br> <input type='text' name='last_name' size=50 required><br>
		Email address *<br> <input type='text' name='email' size=50 required><br>
		Password *<br> <input type='password' name='password' size=50 required><br>
		<input type='hidden' name='timezone'>

	   	<script>
	       	$('input[name=timezone]').val(jstz.determine().name());
	    </script>

		<i>Items marked with * are required</i><br><br>

		<input type='submit' value='Create account'>
		
	</form>
</div>