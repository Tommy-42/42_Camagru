<?php

	if( !empty($_GET['p']) && !isset($_GET['t']) ) {
		switch ( $_GET['p'] ) {
			case 'index':
				include_once $path . '/public/view/index.html';
				break;
			case 'inscription':
				include_once $path . '/public/view/inscription.html';
				break;
			case 'connexion':
				include_once $path . '/public/view/connexion.html';
				break;
			case 'reset_password':
				include_once $path . '/public/view/lost_password.html';
				break;
			default:
				include_once $path . '/public/view/404.html';
				break;
		}
	}
	else if( !empty($_GET['p']) && !empty($_GET['t']) ) {
		switch ( $_GET['p'] ) {
			case 'inscription':
				$token_email = $_GET['t'];

				$update = 'UPDATE users SET active = 1 WHERE token_email = :token_email';
				$mysql = $db->prepare($update);
				$mysql->bindValue(':token_email', $token_email);
				$mysql->execute();
				if( $mysql->rowCount() == 1 ) {

					$update = 'UPDATE users SET token_email = "" WHERE token_email = :token_email';
					$mysql = $db->prepare($update);
					$mysql->bindValue(':token_email', $token_email);
					$mysql->execute();
					
					include_once $path . '/public/view/valide_account.html';
				}
				else
					include_once $path . '/public/view/404.html';
				break;
			case 'reset_password':
				include_once $path . '/public/view/change_password.html';
				break;
			default:
				include_once $path . '/public/view/404.html';
				break;
		}
	}
	else {
		include_once $path . '/public/view/index.html';
	}


?>