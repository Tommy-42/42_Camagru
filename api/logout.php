<?php

	include_once '../config/loader.php';

	if( !empty($_POST['logout']) ) {

		$_SESSION['user'] = NULL;
		$_SESSION['email'] = NULL;
		unset($_SESSION['user']);
		unset($_SESSION['email']);
		die( json_encode(" Delog") );
	}
?>