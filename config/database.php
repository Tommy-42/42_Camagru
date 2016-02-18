<?php
	$DB_HOST = "127.0.0.1:8080";
	$DB_TYPE = "mysql";
	$DB_CHARSET = "UTF8";
	$DB_OPTIONS = array(PDO::ERRMODE_EXCEPTION => true);
	$DB_NAME = "camagru"; 	
	$DB_USER = "camagru";
	$DB_PASSWORD = "toto42";

	$DB_DSN = $DB_TYPE . ":host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";charset=" . $DB_CHARSET;
?>