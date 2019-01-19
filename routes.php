<?php
echo $action.' and '.$controller;
function call($controller, $action) {
	require_once 'controller/'.$controller.'_controller.php';
	switch ($controller) {
		case 'user':
			$controller = new UserController();
			require_once ('model/user_model.php');
			break;
		case 'post':
			$controller = new PostController();
			require_once ('model/post_model.php');
			break;
		case 'home':
			$controller = new HomeController();
			require_once ('model/post_model.php');
			require_once ('model/comments_model.php');
			require_once ('model/user_model.php');
			break;
	}
	$controller->{ $action}();
}
$controllers = array('user' => array('adduser', 'login', 'logout', 'verify', 'resetPW', 'getmail'),
	'post'                     => array('upload', 'edit', 'display'),
	'home'                     => array('feed', 'like', 'comment', 'parsComment', 'undo'));

if (key_exists($controller, $controllers)) {
	if (is_array($controllers[$controller])) {
		call($controller, $action);
	}
} else {
	echo "Page not found";
}
?>
