<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="styles/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    	<div class="content">

        <form method="post" enctype="multipart/form-data">

        <div class="ctx-parent bl">
        	<span>click sicker to modify image</span>
                 <a id='set' href="#">Click to refresh image</a>
                <img class="imgmain" id="pic" src='<?php echo $post->image?>' />
                <img id='img2' hidden="true" src="">
                    <!-- Draggable DIV -->
                <img id="mydiv" src="" alt="" hidden="true" />

        	<canvas class="canv" id='canvas' width="400" height="300" hidden="true"></canvas>

            <input type="text" id='fdata' hidden="true" name="file">
        </div>
        <div class="stickers-parent bl">
        	<ul>
        		<li><a><img alt=""   id="ol1" src="img/stickers/overlay0.png"/><a/></li>
        		<li><img alt=""  id='ol2' src="img/stickers/censor.png"/></li>
        		<li><img alt=""  id='ol3' src="img/stickers/overlay2.png"/></li>
        		<li><img alt=""   id='ol4' src="img/stickers/frame2.png"/></li>
        		<li><img alt=""  id='ol5' src="img/stickers/frame3.png"/></li>
        	</ul>
        </div>
            <input type="submit" name="doEdit" value="Save Image"/>
            <input id="btnCnl" type="submit" name="cancel" value="Cancel"/>
        </form>
        </div>

        <script src="js/modify.js"></script>
    </body>
</html>
