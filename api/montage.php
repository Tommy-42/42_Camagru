<?php

	include_once '../config/loader.php';

	/*
	**	SAVE IMG
	*/
	if( !empty($_POST['save_img']) ) {

		$error = array();

		$remove = array( ' ', 'data:image/png;base64,' );
		$replace = array( '+', '' );
		$user_pic = str_replace($remove, $replace, $_POST['user_pic']);

		if( empty($user_pic) )
			$error[] = 'Image utilisateur non valable';

		$f_url = 'https://e2r13p13:8443/camagru/public/img/pool/filter5.png';
		preg_match('/[^\/]+$/', $f_url, $img);
		if( !empty($img[0]) )
			$filter = $path . '/public/img/pool/' . $img[0];
		else
			$error[] = 'Mauvais filtre.';
		if( empty($error) ) {
			if( check_base64_image($user_pic) && file_exists($filter) )
				echo ' IMG';
			else
				echo ' NOT IMG';
		}
		else
			die(json_encode($error));
	}


?>