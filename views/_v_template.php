<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
    <link rel="stylesheet" type="text/css" href="/css/p2.css"> 

    <!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

    <div id='logo'>
        <h1><img src='/images/wilmington_beach.jpeg' alt='Wilmington, NC Beach' class='small'><?=APP_NAME?></h1>
    </div>

    <div id='menu'>

        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/viewprofile'>Profile</a>
            <a href='/posts/users'>Follow</a>
            <a href='/posts/index'>View Posts</a>
            <a href='/posts/add'>Add Post</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>

        <?php endif; ?>

    </div>

    <br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>