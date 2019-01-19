<html>
	<head>
	<link rel='stylesheet' type="text/css" href="styles/main.css">
	</head>
	<body>
		<div class="content">
			<fieldset>
			<legend>Signup</legend>
			<form method="POST">
				<p>User name	: <input name='login' type="text" required="true" pattern="[A-Za-z0-9]{3,15}" title="Username must contain no special characters and be length of 3 to 15 characters" /></P>
				<p>Email		: <input name='email' type="email" required/></p>
				<p>Password		: <input name='passwd' type="Password" required/></p>
				<p><input id="btnsubmit" type="submit" name='submit' value="Submit"/>
			</form>
			</fieldset>
		</div>
		<script src="js/userCreate.js"></script>
	</body>
</html>
