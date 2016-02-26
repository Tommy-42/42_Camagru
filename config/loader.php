<?php


	//absolute path
	$path = '/goinfre/tpageard/Mamp/apache2/htdocs/camagru';
	
	if( file_exists($path . '/config/flag_install') )
		die('<h1>RUN THE SETUP</h1>');

	// start session
	session_start();
	
	// includes
	include_once 'database.php';
	include_once $path . '/lib/functions.php';


	// create database object
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS)
		or die(print_r($db->errorInfo(), true));
	
	opcache_reset();

	ob_start("ob_gzhandler");

	header("Content-Type: text/html");

?>