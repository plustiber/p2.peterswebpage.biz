<div id = 'home'>
	<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
	<?=APP_NAME?> is a simple microblog.  You can:
	<ul>
		<li>Sign up for an account</li>
		<li>Create blog posts for others to see</li>
		<li>View a list of other users</li>
		<li>Follow other user's posts</li>
		<li>Unfollow someone you are following</li>
		<li>View a list of all posts of users that you are following</li>
	</ul>

	<b>You can also:</b>
	<ul>
		<li>Edit your profile</li>
		<li>Edit a previous post</li>
		<li>Delete a previous post</li>
	</ul>
	<?php if(!$user): ?>
		<br>
		First time users? <a href='/users/signup'>Sign up here</a>
		<br><br>
		Returning users? <a href='/users/login'>Log in here</a>
	<?php endif; ?>
</div>