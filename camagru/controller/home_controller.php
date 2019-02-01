<?php
class HomeController {
	function feed() {
		$count = 0;
		$cond = '%';
		$list = $posts = Post::getPosts(0, 5000, $cond);
		foreach ($list as $li):
			$count++;
		endforeach;

		$limit = 5;
		$pages = ceil($count / $limit);
		if (!isset($_GET['next'])):
			$begin = 0;
			$posts = Post::getPosts($begin, $limit, $cond);
		else:
			$begin = ($_GET['next'] - 1) * $limit;
			$posts = Post::getPosts($begin, $limit, $cond);
		endif;

		require "view/home.php";
	}

	function like() {
		if (isset($_GET['id']) && isset($_SESSION['user'])) {
			$key['p_id'] = $_GET['id'];
			$key['username'] = $_SESSION['user'];
			Post::addLike($key);
			$count = 0;
			$cond = '%';
			$list = $posts = Post::getPosts(0, 5000, $cond);
			foreach ($list as $li):
				$count++;
			endforeach;
			$limit = 5;
			$pages = ceil($count / $limit);
			if (!isset($_GET['next'])):
				$begin = 0;
				$posts = Post::getPosts($begin, $limit, $cond);
			else:
				$begin = ($_GET['next'] - 1) * $limit;
				$posts = Post::getPosts($begin, $limit, $cond);
			endif;

			require "view/home.php";

		} else {
			require_once 'view/loginPage.php';
		}
	}

	function comment() {
		if (isset($_GET['comment']) && isset($_SESSION['user'])) {
			$comment = Post::getOne($_GET['comment']);
			$comenttext = Comment::getComments($_GET['comment']);
			require_once 'view/comment.php';
		}
		if (!isset($_SESSION['user'])) {
			require "view/loginPage.php";
		}
	}

	function parsComment() {
		$tmpA = "comment";
		$tmpC = "home";
		$tmpP = (isset($_GET['comment'])) ? $_GET['comment'] : NULL;

		if (isset($_GET['text']) && isset($_GET['post']) && isset($_SESSION['user'])) {
			$arr['text'] = strip_tags($_GET['text']);
			$arr['user'] = $_SESSION['user'];
			$arr['p_id'] = $_GET['comment'];
			//get user who posted
			$user['u_login'] = $_GET['puser'];
			$postee = User::auth($user);

			if (isset($postee)) {
				$address = $postee['u_email'];
				$subject = 'Camagru';
				$message = $_SESSION['user'] . " commented on your <a href='http://127.0.0.1:8080/camagru/index.php?action=" . $tmpA . "&controller=" . $tmpC . "&comment=" . $tmpP . "'>post</a>";

				mail($address, $subject, $message);
			}

			Comment::addComment($arr);
		}

		if (isset($_GET['comment'])) {
			$comment = Post::getOne($_GET['comment']);
		}

		$comenttext = Comment::getComments($_GET['comment']);

		require_once 'view/comment.php';

	}

	function undo() {

		if (isset($_GET['cid'])) {
			Comment::deleteComment($_GET['cid']);
		}

		if (isset($_GET['comment'])) {
			$comment = Post::getOne($_GET['comment']);
		}

		$comenttext = Comment::getComments($_GET['comment']);

		require_once 'view/comment.php';
	}
}
