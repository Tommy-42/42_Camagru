<?php

	include_once '../config/loader.php';

	/*
	**	INSCRIPTION
	*/
	if( !empty($_POST['inscription']) ) {

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$error = array();
		$valid = array('_', '-');
		// username syntax check
		if( empty($username) ) $error[] = "Username Vide";
		if( strlen($username) > 20 ) $error[] = "Username trop long ( <= 20 )";
		if( !empty($username) && !ctype_alnum(str_replace($valid, '', $username)) )
			$error[] = "Username invalide ( only [A-Z] / [0-9] / '-' / '_' autorisé";

		// email syntax check
		if( strlen($email) > 256 ) $error[] = "Email trop long ( <= 256 )";
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) $error[] = "Invalide Email";

		// password syntax check
		if( empty($password) ) $error[] = "Password Vide";

		if( empty($error) ) {

			$sql = 'SELECT * FROM users WHERE username = :username OR email = :email';
			$mysql = $db->prepare($sql);
			$mysql->bindValue(':username', $username);
			$mysql->bindValue(':email', $email);
			$mysql->execute();

			$result = $mysql->fetchAll( PDO::FETCH_ASSOC );

			if( empty($result) ) {
				
				$token_email = hash('whirlpool', $username.$email.$password);
				
				$insert = 'INSERT INTO users (id, username, email, password, token_email, token_password, active) VALUES ("", :username, :email, :password, :token_email, "", "")';
				$mysql = $db->prepare($insert);
				$mysql->bindValue(':username', $username);
				$mysql->bindValue(':email', $email);
				$mysql->bindValue(':password', hash('whirlpool', $password));
				$mysql->bindValue(':token_email', $token_email);

				if( $mysql->execute() ) {

					$to = $email;
					$from = 'noreply@camagru.fr';
					$subject = 'Validation Compte';
					$message = "
						Bonjour $username,\n
						Nous vous remercions pour votre demande d'inscription.\n
						Cliquez sur le lien suivant pour activer votre compte :\n
						http://127.0.0.1:4242/camagru/index.php?p=inscription&t=$token_email
					";

					$headers = "From: $from"; 
					$ok = @mail($to, $subject, $message, $headers, "-f " . $from);
					die( json_encode("success") );
				}
				else
					die( json_encode("Error Code: " . $mysql->errorCode()) );
			}
			else {
				if( $result[0]['username'] == $username )
					$error[] = 'L\'username existe déjà';
				if( $result[0]['email'] == $email )
					$error[] = 'L\'email existe déjà';
				die( json_encode($error) );
			}
		}
		else
			die( json_encode($error) );
	}

	/*
	**	CONNEXION
	*/
	if( !empty($_POST['connexion']) ) {

		$email = $_POST['email'];
		$password = $_POST['password'];

		$error = array();
		// email syntax check
		if( strlen($email) > 256 ) $error[] = "Email trop long ( <= 256 )";
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) $error[] = "Invalide Email";

		// password syntax check
		if( empty($password) ) $error[] = "Password Vide";

		if( empty($error) ) {

			$sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
			$mysql = $db->prepare($sql);
			$mysql->bindValue(':email', $email);
			$mysql->bindValue(':password', hash('whirlpool', $password));
			$mysql->execute();

			$result = $mysql->fetch( PDO::FETCH_ASSOC );

			if( empty($result) ) {
				die( json_encode('Combinaison incorrect') );
			}
			else {
				if( $result['active'] == 1 ) {
					$_SESSION['user'] = $result['username'];
					$_SESSION['email'] = $result['email'];
					die( json_encode('success') );
				}
				else {
					die( json_encode('Veuillez activer votre compte') );
				}
			}
		}
		else
			die( json_encode($error) );
	}
?>