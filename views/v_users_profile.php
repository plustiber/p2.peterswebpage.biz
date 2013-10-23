<h2>Profile Information</h2>

<form method='POST' action='/users/p_profile'>

	First Name <input type='text' name='first_name' value = <?=$user->first_name?>><br>
	Last Name <input type='text' name='last_name' value = <?=$user->last_name?>><br>
	Email <input type='text' name='email' value = <?=$user->email?>><br>
	
    <?php if(isset($error)): ?>
        <div class='error'>
            <br>Edit Profile failed. Email already in use, please try again.<br>
        </div>
    <?php endif; ?>
	<br>
	<input type='submit' value='Edit Profile'>
	
</form>