<?php

class UserController {
	public function adduser() {
		if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) && isset($_POST['email'])) {
			$user = array(
				'u_login'  => $_POST['login'],
				'u_passwd' => md5($_POST['passwd']),
				'u_email'  => $_POST['email']);
			User::create_user($user);
			/*
			 **$header = 'From:<rootnkosi@gmail.com>'. "\r\n";
			 **mail($_POST['u_email'], "Camagru Registration", "You have just register to camagru.", $header);
			 */
			$hlogin  = ($_POST['login']);
			$message = '

			Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
			<br/>
			Please click this link to activate your account:
			<br/><h3> click
			<a href="http://localhost:8080/camagru/?action=verify&controller=user&usr='.$hlogin.'&stat=active">hear</a>
			 to verify your account';
			$subject = 'Camagru Email Verification';
			$address = $_POST['email'];
			$headers = 'From: camagru@example.com'."\r\n".
			'Reply-To: camagru@example.com'."\r\n".
			'X-Mailer: PHP/'.phpversion();
			mail($address, $subject, $message, $headers);
			require_once ('view/loginPage.php');
		} else {
			require_once "view/createUser.php";
		}
	}

	public function login() {

		$good = 1;
		(!isset($_SESSION) || session_id() == '')?session_start():NULL;
		if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] == "login") {
			$user = array('u_login' => filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING),
				'u_passwd'             => $_POST['passwd']);
			$detail = User::auth($user);
			if (!isset($detail)) {
				echo '<script language="javascript">';
				echo 'alert("Unknown username or email")';
				echo '</script>';
				require_once 'view/loginPage.php';
				$good = 0;
			}

			if ($good === 1) {
				if ($detail['u_passwd'] !== md5($user['u_passwd'])) {
					$good = 0;
				}

				if ($good === 0) {
					echo '<script language="javascript">';
					echo 'alert("Incorrect password or username")';
					echo '</script>';
					require_once 'view/loginPage.php';
				}

				if ($detail['status'] === 'inactive') {
					echo '<script language="javascript">';
					echo 'alert("Your email is not verified")';
					echo '</script>';
					require_once 'view/loginPage.php';
					$good = 0;
				}

				if ($good === 1) {
					$_SESSION['user'] = $user['u_login'];
					$_SESSION['role'] = $detail['u_role'];
				}
				if (isset($_SESSION['user'])) {
					echo "<p> Welcome ".$_SESSION['user']."</p>";
				}
				if ($good === 1) {
					call('home', 'feed');
				}
			}

		} else {
			require_once 'view/loginPage.php';
		}
	}

	public function logout() {
		if (isset($_SESSION['user'])) {
			session_destroy();
		} else {

			echo "<div class='flash'><p> It seems you are not logged in </p></div>";
		}
	}

	public function verify() {
		if (isset($_GET['usr']) && isset($_GET['stat'])) {
			User::setStatus($_GET['stat'], $_GET['usr']);
			require ('view/verifyEmail.php');
		}
	}

	public function resetPW() {
		if (isset($_GET['email'])) {
			$mail = $_GET['email'];

		}

		if (isset($_POST['passwd1'])) {
			User::deleteUser($_POST['name'], $_POST['passwd1'], $mail);
		}
		require ('view/resetPassword.php');
	}

	public function getmail() {
		echo "hear";
		if (isset($_POST['mail'])) {
			$message = '
				<br/>
				<h3><a href="http://localhost:8080/camagru/?action=resetPW&controller=user&email='.$_POST['mail'].'&stat=active">Click this link to reset your password</a><h3>';
			$subject = "Password reset";
			$address = $_POST['mail'];
			mail($address, $subject, $message);
		} else {
			require_once ('view/emailForm.php');
		}
	}

	public function delete() {
		if (isset($_GET['uname'])):
		User::deleteUser($_GET['uname']);
		endif;
		$this::showUsers();
	}

	public function showUsers() {
		$users = User::getAll('%');
		require 'view/viewUser.php';
	}
}
?>