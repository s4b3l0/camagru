<?php

class UserController {
	public function adduser() {
		$good = 1;
		if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) && isset($_POST['email'])) {
			$user = array(
				'u_login' => filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING),
				'u_passwd' => md5($_POST['passwd']),
				'u_email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

			$temp['u_login'] = $user['u_login'];
			$detail = User::auth($temp);
			if (isset($detail)) {
				$good = 0;
				echo '<script language="javascript">';
				echo 'alert("Username is already in use!")';
				echo '</script>';
			}
			if ($good == 1):
				unset($detail);
				unset($temp);
				$temp['u_login'] = $user['u_email'];
				$detail = User::auth($temp);
				if (isset($detail)):
					$good = 0;
					echo '<script language="javascript">';
					echo 'alert("Email is already taken")';
					echo '</script>';
				endif;
			endif;

			if ($good == 1):
				User::create_user($user);
				/*
					 **$header = 'From:<rootnkosi@gmail.com>'. "\r\n";
					 **mail($_POST['u_email'], "Camagru Registration", "You have just register to camagru.", $header);
				*/
				$hlogin = ($_POST['login']);
				$message = '

														Thanks for signing up!
														Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
														<br/>
														Please click this link to activate your account:
														<br/><h3> click
														<a href="http://localhost:8080/camagru/?action=verify&controller=user&usr=' . $hlogin . '&stat=active">hear</a>
														 to verify your account';
				$subject = 'Camagru Email Verification';
				$address = $_POST['email'];
				$headers = 'From: camagru@example.com' . "\r\n" .
				'Reply-To: camagru@example.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				mail($address, $subject, $message, $headers);
				require_once 'view/loginPage.php';
			elseif ($good == 0):
				require_once "view/createUser.php";
			endif;
		} else {
			require_once "view/createUser.php";
		}
	}

	public function login() {
		if (isset($_SESSION['user'])) {
			session_destroy();
		}
		$good = 1;
		(!isset($_SESSION) || session_id() == '') ? session_start() : NULL;
		if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] == "login") {
			$user = array('u_login' => filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING),
				'u_passwd' => $_POST['passwd']);
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
					echo 'alert("Your email is not verified reset your password to verify")';
					echo '</script>';
					require_once 'view/loginPage.php';
					$good = 0;
				}

				if ($good === 1) {
					$_SESSION['user'] = $user['u_login'];
					$_SESSION['role'] = $detail['u_role'];
					echo $_SESSION['role'];
				}
				if (isset($_SESSION['user'])) {
					echo '<script language="javascript">';
					echo "alert(Welcome  " . $_SESSION['user'] . " )";
					echo '</script>';
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
		require_once 'view/loginPage.php';
	}

	public function verify() {
		if (isset($_GET['usr']) && isset($_GET['stat'])) {
			User::setStatus($_GET['stat'], $_GET['usr']);
			require 'view/verifyEmail.php';
		}
	}

	public function resetPW() {
		$good = 1;

		if (isset($_GET['email'])) {
			$mail = $_GET['email'];
		}
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$passwd = filter_input(INPUT_POST, 'passwd1', FILTER_SANITIZE_STRING);
		if (isset($name) && isset($passwd)) {
			$user['u_login'] = $name;
			$detail = User::auth($user);
			if (isset($detail)) {
				$good = 0;
				echo '<script language="javascript">';
				echo 'alert("Username is already in use!")';
				echo '</script>';
			}
			if ($good == 1) {
				User::updateUser($name, $passwd, $mail);
				User::setStatus('active', $name);
				echo '<script language="javascript">';
				echo 'alert("Account updated and active!")';
				echo '</script>';
				require_once 'view/loginPage.php';
			} elseif ($good == 0) {
				require 'view/resetPassword.php';
			}
		} else {
			require 'view/resetPassword.php';
		}

	}

	public function getmail() {
		echo "hear";
		$good = 1;
		if (isset($_POST['mail'])) {
			$user['u_email'] = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
			$temp['u_login'] = $user['u_email'];
			$detail = User::auth($temp);
			if (!isset($detail)):
				$good = 0;
				echo '<script language="javascript">';
				echo 'alert("That email is not registered with us")';
				echo '</script>';
			endif;

			if ($good == 1):
				$message = '
															<br/>
															<h3><a href="http://localhost:8080/camagru/?action=resetPW&controller=user&email=' . $_POST['mail'] . '&stat=active">Click this link to reset your password</a><h3>';
				$subject = "Password reset";
				$address = $_POST['mail'];
				mail($address, $subject, $message);
				printf("<br/><br/><br/><br/><div>%s</div>", $message);
			elseif ($good == 0):
				require_once 'view/emailForm.php';
			endif;
		} else {
			require_once 'view/emailForm.php';
		}
	}

	public function delete() {
		if (isset($_GET['uname'])):
			User::deleteUser($_GET['uname']);
			echo '<script language="javascript">';
			echo 'alert("A user has been deleted")';
			echo '</script>';
		endif;
		$this::showUsers();
	}

	public function showUsers() {
		if (isset($_SESSION['user'])):
			if ($_SESSION['role'] == 'Admin'):
				$users = User::getAll('%');
				require 'view/viewUser.php';
			else:
				require_once 'view/loginPage.php';
				echo '<script language="javascript">';
				echo 'alert("Please login as administrator to access page")';
				echo '</script>';
			endif;
		elseif (!isset($_SESSION['user'])):
			require_once 'view/loginPage.php';
		endif;
	}
}
?>