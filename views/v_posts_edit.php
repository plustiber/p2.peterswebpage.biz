<form method='POST' action='/posts/p_edit' class='profile'>

    <label for='content'>Post:</label><br>
    <textarea name='content' id='content' rows=4 cols=50 required autofocus><?=$post['content']?></textarea>
    <input type='hidden' name='post_id' value=<?=$post['post_id']?>>

    <br><br>
    <input type='submit' value='Update post'>

</form> 