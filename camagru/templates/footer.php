<?php

?>
<html>
    <head>
        <meta charset="UTF-8">
		  <link rel='stylesheet' type="text/css" href="styles/main.css">
    </head>
<body  class="page">
<div class='footer' >
    <a class="extra"><?php
if (isset($_SESSION['user'])):
echo $_SESSION['user'];
endif;?></a>
</div>
</body>
</html>
