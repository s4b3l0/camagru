<html>
<head>
<link rel='stylesheet' type="text/css" href="styles/main.css">
</head>
<body>

	<div id="content" class="camera-area">
		<div class='comment-space'>
		<form method='get'>
<?php

echo "<img src='$comment->image'>";

?>
			<p><input name='text' placeholder='Write comment here' /></p>
			<p><input type='submit' name='post' value='POST' ></p>
			<input type="text" name="puser" hidden="true" value="<?php echo ($comment->username) ?>" />
			<input name='controller' value='home' hidden='true' />
			<input name='action' value='parsComment' hidden='true' />
			<input name='comment' value='<?php echo $_GET['comment'] ?>' hidden='true'/>
<?php

if (isset($comenttext)) {
	foreach ($comenttext as $com) {
		$btndel = NULL;
		$btndel = ($com->u_name == $_SESSION['user']) ?
		("<a class='homeComment' href='?action=undo&controller=home&cid=" . $com->comid . "&comment=" . $comment->id . "' >🚮</a>") : (NULL);

		echo "
				<div class='com-text'>
				<form>
				<fieldset>
					<legend>$com->u_name</legend>
					<p> $com->comment</p>" . $btndel . "
				</fieldset></form>
				</div>
";
	}
}

?>
</form>
		</div>
	</div>
</body>
</html>