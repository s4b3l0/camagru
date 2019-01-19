<html>
<head>
<link rel='stylesheet' type="text/css" href="styles/main.css">
</head>
<body>
<form method='get'>


<div class="content">
<span>Pages :
<?php
$counter = 0;
while (++$counter <= $pages):
echo "       <a href='?action=feed&controller=home&next=$counter'>$counter</a>";
endwhile;

?>
</span>
	<input name='action' value='feed' hidden='true' />
	<input name='controller' value='home'hidden='true' />
<?php
$tmp = '';
if (is_array($posts)) {
	foreach ($posts AS $post) {
		$tmp = $tmp."<br/><div class=postview >
	    	<span>$post->username</span>
	       	<img src='$post->image'>
$post->likes : likes
		       <br/>
		  <a class='' href='?action=like&controller=home&id=" .$post->id."'>like</a>
		  <a class='' href='?action=comment&controller=home&comment=".$post->id."'>comment</a>
		  </div>";
	}
} else {
	echo "<span> Gallery not available </span>";
}
echo $tmp;
?>
<br/>

	<br/>

<span>Pages :
<?php
$counter = 0;
while (++$counter <= $pages):
echo "       <a href='?action=feed&controller=home&next=$counter'>$counter</a>";
endwhile;
?></span>
</div>

</form>
	<!--<script src="js/viewPost.js"></script>-->
</body>
</html>
