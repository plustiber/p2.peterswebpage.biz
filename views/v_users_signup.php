<h2>Sign Up</h2>

<form method='POST' action='/users/p_signup'>

	First Name <input type='text' name='first_name'><br>
	Last Name <input type='text' name='last_name'><br>
	Email <input type='text' name='email'><br>
	Password <input type='password' name='password'><br>
	<input type='hidden' name='timezone'>

   	<script>
        $('input[name=timezone]').val('America/New_York');
       	//$('input[name=timezone]').val(jstz.determine().name());
    </script>

	<input type='submit' value='Sign Up'>
	
</form>
