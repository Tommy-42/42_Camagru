<?php
	//absolute path
	$path = '/nfs/zfs-student-3/users/tpageard/Mamp/apache2/htdocs/camagru';
	
	// includes
	include_once 'database.php';
	include_once $path . '/lib/functions.php';

	// start session
	session_start();

	// create database object
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);


?>