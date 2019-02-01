<html>
<head>
<link rel='stylesheet' type="text/css" href="styles/main.css">
</head>
<body>
<form method='get' action="http://127.0.0.1:8080/camagru/index.php?action=feed&controller=home">


<div class="content">
<span>
<?php
if (isset($posts)):
	$counter = 0;
	while (++$counter <= $pages):
		echo "       <a href='?action=feed&controller=home&next=$counter'>$counter</a>";
	endwhile;
endif
?>
</span>
	<input name='action' value='feed' hidden='true' />
	<input name='controller' value='home'hidden='true' />

	</legend>

</fieldset>

<?php
$tmp = '';

if (is_array($posts)) {
	foreach ($posts AS $post) {
		$tmp = $tmp . "<br/><div class=postview >
	    	<fieldset>
	    	<legend>$post->username</legend>
	       	<img src='$post->image'>
		  <a class='homeButtons' styles='border-bottom-left-radius: 10px;' href='?action=like&controller=home&id=" . $post->id . "'>👍  $post->likes </a>
		  <a class='homeButtons' styles='border-bottom-right-radius: 10px;'  href='?action=comment&controller=home&comment=" . $post->id . "'>💬</a>
		  </div></fieldset>";
	}
} else {
	echo "<span> Gallery not available </span>";
}
echo $tmp;
?>
<br/>

	<br/>
</div>

</form>
	<!--<script src="js/viewPost.js"></script>-->
</body>
</html>
