<html>
    <head>
        <link href="../styles/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    	<div class='content'>
<?php
$tmp = '';
foreach ($posts as $post) {
	$tmp = $tmp."<br/><div class=postview >
                    <img src='$post->image'> "
	 ." <a class='' href='?action=edit&controller=post&id=".$post->id."'>Edit</a> ".
	"<a class='' href = '?action=delete&controller=post&id=".$post->id."'>delete</a> ";

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
    </body>
</html>
<a href="../phpinfo.php"></a>