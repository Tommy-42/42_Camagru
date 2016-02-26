<?php

	if (php_sapi_name() != 'cli' || $_SERVER['REMOTE_ADDR'] != 'localhost') {

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);

		header("Pragma: no-cache");
		header("Location: /camagru/?p=index");

		exit;
	}

	//absolute path
	$path = '/goinfre/tpageard/Mamp/apache2/htdocs/camagru';

	// includes
	include_once 'database.php';
	include_once $path . '/lib/functions.php';


	// create database object
	$db = new PDO("mysql:host=$DB_HOST", $DB_ROOT, $DB_P_ROOT);

	$db->exec("CREATE DATABASE `$DB_NAME`;
        CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
        GRANT ALL ON `$DB_NAME`.* TO '$DB_USER'@'localhost';
        FLUSH PRIVILEGES;"
    );
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
	$sql = file_get_contents('camagru.sql');
	$db->exec($sql);
?>