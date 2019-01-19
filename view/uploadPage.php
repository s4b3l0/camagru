<html>
	<head>
		<link rel='stylesheet' type="text/css" href="styles/main.css">
	</head>
	<body>
		<div id="media" class="camera-area">
			<div class="booth">
				<video class='vid' id="video"></video>
				<a href="#" id="btn_capture" class="booth-button">Capture Image</a>
				<a href="#" id="btn_usecam" class="booth-button">Use Camera</a>
				<a href="#" id="btn_use" class="booth-button">Use Image</a>
				<a href="#" id="btn_cancel" class="booth-button">Cancel</a>
				<canvas id="canvas" width="400" height="300" hidden="true"></canvas>
			</div>
			<div id="stack" class="playground" style="background-color: darkgray;">
				<img id='photo' src="">

			</div>
		</div>
		<div id='frmUpload' class="content">
			<fieldset>
				<legend>Post An Image</legend>
				<form method="post" enctype="multipart/form-data">
					<p id='p_caption'>Caption: <br/><input type="text" name="caption" required /></p>
					<p><input hidden='true' id="inpic" name="cam_data"></p>
					<p id='p_attach'><a class="booth-button" id="btntake" >Capture Image</a>
					or Insert Image: <br/><input id="inp_image" type="file" value="sabelo" name="image"></p>
					<p><input type="submit" id="btn_submit" name="ok" value="Post Image"></p>
				</form>
			</fieldset>
</div>
		<script src="js/cam.js"></script>
	</body>
</html>