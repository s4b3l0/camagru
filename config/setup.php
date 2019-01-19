<?php
require_once "../connection.php";
Db::makeDB();
//echo $sql;
$db = Db::getInstance();

$lines = file(realpath("testdb.sql"));

$error   = '';
$tmpline = '';

foreach ($lines as $line) {
	if (substr($line, 0, 2) == '--' || $line == '') {
		continue;
	}

	$tmpline .= $line;
	if (substr(trim($line), -1, 1) == ';') {
		try
		{
			$db = Db::getInstance();
			$db->exec($tmpline);
			$tmpline = '';
		}
		 catch (PDOException $ex) {
			echo "<br/><br/>ERROR:".$ex->getMessage();
		}
	}
	try
	{
		$db  = Db::getInstance();
		$sql = "SHOW TABLES;";
		$res = $db->query($sql)->fetchAll();
	}
	 catch (PDOException $ex) {
		echo "<br/><br/>ERROR:".$ex->getMessage();
	}
}
?>

