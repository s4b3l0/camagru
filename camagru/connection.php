<?php
include "config/database.php";

class Db {

	private static $setup = NULL;
	private static $instance = NULL;
	private static $name = 'testdb';

	public static function getSetup() {
		global $DB_DSN, $DB_USER, $DB_PASSWORD;
		if (!isset(self::$setup)) {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$setup = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $pdo_options);
		}
		return self::$setup;
	}

	public static function makeDB() {
		$sql = "DROP DATABASE IF EXISTS testdb;";
		self::getSetup()->exec($sql);
		$sql = "CREATE DATABASE IF NOT EXISTS testdb;";
		self::getSetup()->exec($sql);
	}

	public static function getInstance() {
		global $DB_DSN, $DB_USER, $DB_PASSWORD;
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO($DB_DSN . ';dbname=testdb', $DB_USER, $DB_PASSWORD, $pdo_options);
		}
		return self::$instance;
	}

	public function execute($sql) {
		try {
			$db = self::getInstance();
			$db->prepare($sql);
			$db->exec($sql);
		} catch (PDOException $ex) {
			echo '<script language="javascript">';
			echo 'alert("Could not process data please try again later!")';
			echo '</script>';
		}
	}

}
