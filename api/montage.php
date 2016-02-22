<?php

	include_once '../config/loader.php';

	/*
	**	SAVE IMG
	*/
	if( !empty($_POST['save_img']) ) {

		$remove = array( ' ', 'data:image/png;base64,' );
		$replace = array( '+', '' );
		$user_pic = str_replace($remove, $replace, $_POST['user_pic']);
		if ( check_base64_image($user_pic) ) 
			echo ' IMG';
		else
			echo ' NOT IMG';
	}

?>