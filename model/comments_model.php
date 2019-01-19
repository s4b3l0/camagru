<?php
require_once ('connection.php');
class Comment {
	public $comid;
	public $comment;
	public $date;
	public $u_name;

	public function __construct($arr) {
		$this->comid   = $arr['c_id'];
		$this->comment = $arr['c_text'];
		$this->date    = $arr['c_date'];
		$this->u_name  = $arr['u_name'];
	}

	public function getComments($cond) {
		$sql = "SELECT c_id,c_text, c_date, u_name
			FROM comments
			WHERE p_id ='$cond'
			ORDER by c_date DESC";
		$db   = Db::getInstance();
		$req  = $db->query($sql);
		$tb   = $req->fetchAll();
		$list = [];
		foreach ($tb AS $com) {
			$list[] = new Comment($com);
		}
		return ($list);
	}

	public function addComment($arr) {
		$sql = "INSERT INTO comments(c_text, u_name, p_id) VALUES ('".$arr['text']."','".$arr['user']."','".$arr['p_id']."')";
		Db::execute($sql);
	}

	public function deleteComment($comid) {
		$sql = "DELETE FROM comments WHERE comments.c_id = '".$comid."';";
		Db::execute($sql);
	}

}
?>
