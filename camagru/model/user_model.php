<?php
require_once "connection.php";
class User {
	public $login;
	public $user_name;
	public $surname;
	public $sex;
	public $email;
	public $status;
	public $password;

	public function __construct($arr) {
		$this->login     = $arr['u_login'];
		$this->user_name = $arr['u_name'];
		$this->surname   = $arr['u_surname'];
		$this->role      = $arr['u_role'];
		$this->email     = $arr['u_email'];
		$this->status    = $arr['status'];
	}

	function create_user($user) {
		$sql = "INSERT INTO users(u_login, u_passwd, u_email)
				values('".$user['u_login']."', '".$user['u_passwd']."','".$user['u_email']."')";
		Db::execute($sql);
	}

	public function getAll($cond) {
		$sql = "SELECT u_login, u_name, u_surname, u_email, u_role, status
			FROM users WHERE status LIKE '".$cond."';
";
		$db  = Db::getInstance();
		$req = $db->query($sql);
		$tb  = $req->fetchAll();
		foreach ($tb as $users) {
			$list[] = new User($users);
		}
		return ($list);
	}

	public function auth($user) {
		$sql = "SELECT u_login, u_passwd, status, u_email, u_role
				FROM users
				WHERE u_login LIKE '".$user['u_login']."'
				OR u_email LIKE '".$user['u_login']."';
";
		$db  = Db::getInstance();
		$req = $db->query($sql);
		$n   = 0;
		foreach ($req->fetchAll() as $key) {
			$n++;
			if ($n === 1) {
				return ($key);
			}
		}
	}

	public function setStatus($stat, $user) {
		$sql = "UPDATE users SET status ='".$stat."' WHERE u_login ='".$user."';";
		Db::execute($sql);
	}

	public function deleteUser($username) {
		$sql = "DELETE FROM users WHERE u_login = '".$username."';";
		Db::execute($sql);
	}

	public function updateUser($user, $password, $mail) {
		$sql = "UPDATE users SET u_login ='".$user."', u_passwd='".md5($password)."' WHERE u_email = '".$mail."';";
		Db::execute($sql);
	}

	public function deActivate($username) {
		$sql = "UPDATE user SET status  = 'inactive';";
		Db::execute($sql);
	}
}
?>
