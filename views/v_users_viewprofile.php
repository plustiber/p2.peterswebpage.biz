<div>
	<h2>Profile Information</h2>
	<div class='profile'>

		Name: <?=$user->first_name?> <?=$user->last_name?> <br>
		Email address: <?=$user->email?> <br>

	    <?php if($user->location != ""): ?>
			Location: <?=$user->location?><br>
	    <?php endif; ?>

	    <br>
	    <a href='/users/editprofile'>Edit Profile</a>

	</div>

	<h2>User Posts</h2>
	<div class='post'>
		<?php foreach($posts as $post): ?>

			<article id='post'>

			    <p><?=$post['content']?></p>

			    <p><time datetime="<?=Time::display($post['created'],'Y-m-d g:i')?>">
			        <?=Time::display($post['created'])?>
			    </time></p>

			    <a href='/posts/delete/<?=$post['post_id']?>'>Delete Post</a>

			</article>

		<?php endforeach; ?>
	</div>
</div>
