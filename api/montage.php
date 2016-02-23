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
		$f_url = $_POST['filter'];

		if( empty($user_pic) )
			$error[] = 'Image utilisateur manquante';
		if( empty($f_url) )
			$error[] = 'Filtre utilisateur manquant';

		preg_match('/[^\/]+$/', $f_url, $img);
		if( !empty($img[0]) )
			$filter = $path . '/public/img/pool/' . $img[0];
		else
			$error[] = 'Mauvais filtre.';
		if( empty($error) ) {
			if( check_base64_image($user_pic) && file_exists($filter) ) {

				// create ressources
				$src = imagecreatefrompng($filter);
				$dest = imagecreatefromstring(base64_decode($user_pic));

				// set alpha
				imagealphablending($dest, true);
				imagesavealpha($dest, false);

				// merge pictures
			    imagecopy($dest, $src, 0, 0, 0, 0, 320, 240);

			    // save img into galerie folder
			    $randName = generateRandomString(100);
			    $name = $path . '/private/galerie/' . $randName . '.png';
			    imagepng($dest, $name);

			    // release ressources
			    imagedestroy($dest);
			    imagedestroy($src);

			    // save img into db
			    $insert = 'INSERT INTO images (id, name, user_id) VALUES ("", :name, :user_id)';
				$mysql = $db->prepare($insert);
				$mysql->bindValue(':name', $randName);
				$mysql->bindValue(':user_id', $_SESSION['user_id']);
				if( $mysql->execute() )
					die(json_encode(array('success' => '/camagru/private/galerie/' . $randName . '.png')));
			}
			else {
				$error[] = "Mauvaise Image utilisateur";
				die(json_encode($error));
			}
		}
		else
			die(json_encode($error));
	}


?>