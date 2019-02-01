<html>
	<head>
	<link rel='stylesheet' type="text/css" href="styles/main.css">
	</head>
	<body>
		<div class="content">
		<fieldset>
			<legend>Sign In</legend>
			<form action="index.php?action=login&controller=user" method="POST">
				<p>Username		: <br/><input name='login' type="text" required="true" pattern="[A-Za-z0-9]{3,15}" title="Username must contain no special characters and be length of 3 to 15 characters" /></P>
				<p>Password		: <br/><input name='passwd' type="password" required="true" /></p>
				<p><input type="submit" name='submit' value="login"/> Click <a href="?action=adduser&controller=user">Here</a> to signup</p>
				<p><a href="?action=getmail&controller=user">I have forgoten my password</a></p>
			</form>
		</fieldset>
		</div>
	</body>
	</html>