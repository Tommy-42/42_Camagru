<?php
	//absolute path
	$path = '/goinfre/tpageard/Mamp/apache2/htdocs/camagru';

	// start session
	session_start();
	
	// includes
	include_once 'database.php';
	include_once $path . '/lib/functions.php';


	// create database object
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);

	ob_start("ob_gzhandler");
?>