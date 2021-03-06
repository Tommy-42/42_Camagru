<?php

	if ( php_sapi_name() != 'cli' ) {
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
    ) or die(print_r($db->errorInfo(), true));

	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
	
	$sql = file_get_contents('camagru.sql');
	$db->exec($sql);

	unlink($path . '/config/flag_install');
?>