<html>
	<head>
	<link rel='stylesheet' type="text/css" href="styles/main.css">
	</head>
	<body>
		<div class="content">
			<form method='get'>
				<input name=action value = 'delete' hidden='true' >
                <input name=controller value='user' hidden='true'>
                <table>
<?php
foreach ($users AS $user) {
	echo "<tr>
                        <td>".$user->login."</td>
                        <td>".$user->user_name."</td>
                        <td>".$user->email."</td>
                        <td>".$user->status."</td>
                        <td><button name='uname' value='".$user->login."'>Delete</button></td>
                        </tr>";
}
?>
                </table>
                </form>
		</div>
		<script src="js/userCreate.js"></script>
	</body>
</html>