<div class='profile'>
	<h2>Profile Information</h2>

	<form method='POST' action='/users/p_editprofile'>

		First name: *<br> <input type='text' name='first_name' value = <?=$user->first_name?> size=50 required autofocus><br>
		Last name: *<br> <input type='text' name='last_name' value = <?=$user->last_name?> size=50 required><br>
		Email address: *<br> <input type='text' name='email' value = <?=$user->email?> size=50 required><br>
		Password: *<br> <input type='password' name='password' size=50 required><br>
		Location: <br> <input type='text' name='location' value = '<?=$user->location?>' size=50><br>
		<input type='hidden' name='timezone'>

	   	<script>
	       	$('input[name=timezone]').val(jstz.determine().name());
	    </script>

		<i>Items marked with * are required</i><br><br>

	    <?php if(isset($error)): ?>
	        <div class='error'>
	            <br>Error - email already in use, please try again.<br>
	        </div>
	    <?php endif; ?>

		<input type='submit' value='Edit profile'>
		
	</form>
</div>