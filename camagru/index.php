<?php
require_once ('connection.php');
//echo "on root index.php";

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action     = $_GET['action'];
} else {
	$controller = 'home';//default controller
	$action     = 'feed';//default action
}
require 'template.php';
require_once ('routes.php');

require 'templates/footer.php';
