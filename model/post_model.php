<?php
require_once "connection.php";
class Post {
	public $id;
	public $image;
	public $caption;
	public $username;
	public $date;
	Public $likes;

	public function __construct($post) {
		$this->id       = $post['p_id'];
		$this->image    = $post['p_attachment'];
		$this->caption  = $post['p_caption'];
		$this->username = $post['u_name'];
		$this->date     = $post['p_date'];
		$this->likes    = isset($post['likes'])?$post['likes']:null;
	}
	public function create_post($post) {
		$sql = "INSERT INTO posts(p_attachment,p_caption, u_name, p_edited)
			VALUES ('".$post['path']."','".$post['caption']."','".$post['name']."' , '".$post['edit']."')";
		Db::execute($sql);
	}
	public function getPosts($begin, $limit, $cond) {

		$sql = "	SELECT p_id, p_attachment, p_caption, p_date, u_name
					FROM posts
					WHERE  u_name
					LIKE '".$cond."' ORDER BY p_date DESC LIMIT ".$limit." OFFSET ".$begin.";
";
		$list = [];
		try
		{
			$db  = Db::getInstance();
			$req = $db->query($sql);
			$tb  = $req->fetchAll();
			foreach ($tb as $post) {
				$sql           = "SELECT COUNT(*) as 'likes' FROM likes WHERE p_id = ".$post['p_id'].";";
				$post['likes'] = $db->query($sql)->fetchColumn();
				$list[]        = new Post($post);
			}
			return ($list);
		}
		 catch (PDOException $ex) {
		}
		return ($list);
	}

	public function addLike($key) {
		$sql      = "SELECT * FROM likes WHERE p_id LIKE '".$key['p_id']."' AND u_name LIKE '".$key['username']."'";
		$db       = Db::getInstance();
		$req      = $db->query($sql);
		$username = $key['username'];
		$n        = 0;
		foreach ($req->fetchAll() as $key) {
			$n++;
		}
		if ($n === 0) {
			$sql = "INSERT INTO likes(p_id, u_name) VALUES('".$key['p_id']."','".$username."')";
			Db::execute($sql);
		} else {
			$sql = "DELETE FROM likes WHERE p_id = '".$key['p_id']."' AND u_name = '".$username."';";
			echo $sql;
			Db::execute($sql);
		}
	}

	public function unLike($key) {
		$sql = "DELETE FROM likes WHERE p_id = '".$key['p_id']."' AND u_name = '".$key['user']."';";
		Db::execute($sql);
	}

	public function addComment($key) {
		$sql = "INSERT INTO comments(u_name, c_text) VALUES('".$key['user']."','".$key['text']."');";
		Db::execute($sql);
	}

	public function getOne($id) {

		$sql = "SELECT p_id, p_attachment, p_caption, p_date, u_name FROM posts WHERE p_id =".$id."";
		try
		{
			$db     = Db::getInstance();
			$req    = $db->query($sql);
			$tb     = $req->fetch();
			$object = new Post($tb);
		}
		 catch (PDOException $ex) {
		}
		return ($object);
	}

	public function delete($id)
	{
		$sql = "DELETE FROM posts WHERE p_id = '".$id."';";
		Db::execute($sql);
	}
}
