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
			default:
				include_once $path . '/public/view/404.html';
				break;
		}
	}
	else if( !empty($_GET['p']) && $_GET['p'] == 'inscription' && !empty($_GET['t']) ) {

		$token_email = $_GET['t'];

		$update = 'UPDATE users SET active = 1 WHERE token_email = :token_email';
		$mysql = $db->prepare($update);
		$mysql->bindValue(':token_email', $token_email);
		$mysql->execute();
		if( $mysql->rowCount() == 1 ) {
			include_once $path . '/public/view/valide_account.html';
		}
		else
			include_once $path . '/public/view/404.html';
	}
	else {
		include_once $path . '/public/view/index.html';
	}


?>