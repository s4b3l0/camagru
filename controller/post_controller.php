<?php
define("FILE_REPO", "img/uploads/");
class PostController {
	public function upload() {
		if (isset($_POST['ok']) && ((is_uploaded_file($_FILES['image']['tmp_name']) || isset($_POST['cam_data'])) && $_SESSION['user'])) {
			if (isset($_POST['cam_data'])) {
				$filName  = FILE_REPO.time().rand(1, 300000).$_SESSION['user'].'.png';
				$img      = $_POST['cam_data'];
				$img      = str_replace('data:image/png;base64,', '', $img);
				$img      = str_replace(' ', '+', $img);
				$fileData = base64_decode($img);

				file_put_contents($filName, $fileData);

			}
			if (is_uploaded_file($_FILES['image']['tmp_name'])) {
				$filName = FILE_REPO.time().rand(1, 300000).$_SESSION['user'];
				$results = move_uploaded_file($_FILES['image']['tmp_name'], $filName.$_FILES['image']['name']);
				$filName = $filName.$_FILES['image']['name'];
			}
			$post['path']    = $filName;
			$post['name']    = $_SESSION['user'];
			$post['caption'] = $_POST['caption'];
			$post['edit']    = 0;
			Post::create_post($post);
		}
		if (isset($_SESSION['user'])):
		require_once 'view/uploadPage.php';
		endif;
	}

	public function display() {
		$count = 0;
		$cond  = $_SESSION['user'];
		$list  = $posts  = Post::getPosts(0, 5000, $cond);
		foreach ($list as $li):
		$count++;
		endforeach;

		$limit = 5;
		$pages = ceil($count/$limit);
		if (!isset($_GET['next'])):
		$begin = 0;
		$posts = Post::getPosts($begin, $limit, $cond);
		 else :
		$begin = ($_GET['next']-1)*$limit;
		$posts = Post::getPosts($begin, $limit, $cond);
		endif;

		echo ($pages);
		require_once 'view/mygallery.php';
	}

	public function edit() {
		$post = Post::getOne($_GET['id']);
		if (isset($_POST['file']) && isset($_POST['doEdit'])) {
			$filName  = FILE_REPO.time().rand(1, 300000).$_SESSION['user'].'.png';
			$img      = $_POST['file'];
			$img      = str_replace('data:image/png;base64,', '', $img);
			$img      = str_replace(' ', '+', $img);
			$fileData = base64_decode($img);

			file_put_contents($filName, $fileData);
			$pst['path']    = $filName;
			$pst['name']    = $_SESSION['user'];
			$pst['caption'] = "..";
			$pst['edit']    = 1;
			Post::create_post($pst);
		}

		require_once 'view/editPage.php';
	}

	function delete() {
		$good = 0;
		if (isset($_SESSION['user'])) {
			$good = 1;
		}

		if ($good == 0) {
			require_once ('view/loginPage.php');
		}

		if ($good == 1 && isset($_GET['id'])) {
			Post::delete($_GET['id']);
		}
		$this::display();
	}

}