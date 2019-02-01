<html>
    <head>
        <link href="../styles/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    	<div class='content'>
<p>
<?php
$counter = 0;
while (++$counter <= $pages):
	echo " <a href='?action=feed&controller=home&next=$counter'>$counter</a>";
endwhile;
?></p>




<?php
$tmp = '';
foreach ($posts as $post) {
	$tmp = $tmp . "<br/><div class=postview ><fieldset>
                    <img src='$post->image'> "
	. " <a class='homeButtons
     ' href='?action=edit&controller=post&id=" . $post->id . "'>🎨</a> " .
	"<a class='homeButtons' href = '?action=delete&controller=post&id=" . $post->id . "'>🚮</a></div></fieldset>";

}
echo $tmp;
?>
	</div>
    </body>
</html>
<a href="../phpinfo.php"></a>