<?php foreach($posts as $post): ?>

	<article id='post'>

	    <h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>

	    <p><?=$post['content']?></p>

	    <h6><time datetime="<?=Time::display($post['created'],'Y-m-d g:i')?>">
	        <?=Time::display($post['created'])?>
	    </time></h6>

	</article>

<?php endforeach; ?>
