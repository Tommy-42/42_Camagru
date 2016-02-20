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
		if( empty($password) ) $error[] = "Mot de passe Vide";
		if( !empty($password) && strlen($password) < 8 ) $error[] = "Mot de passe trop petit ( 8 caracteres min )";
		if( ctype_alpha($password) ) $error[] = "Le mot de passe doit contenir au moins un chiffre";

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
						http://127.0.0.1:8080/camagru/index.php?p=inscription&t=$token_email
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

	/*
	**	RESET PASSWORD
	*/
	if( !empty($_POST['reset_password']) ) {

		$email = $_POST['email'];

		$error = array();
		// email syntax check
		if( strlen($email) > 256 ) $error[] = "Email trop long ( <= 256 )";
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) $error[] = "Invalide Email";

		if( empty($error) ) {

			$sql = 'SELECT * FROM users WHERE email = :email';
			$mysql = $db->prepare($sql);
			$mysql->bindValue(':email', $email);
			$mysql->execute();

			$result = $mysql->fetchAll( PDO::FETCH_ASSOC );

			if( !empty($result) ) {

				$username = $result[0]['username'];
				$token_password = hash('whirlpool', $username.$email);
				
				if( $result[0]['token_password'] != '' ) {
					$update = 'UPDATE users SET token_password = :token_password WHERE email = :email';
					$mysql = $db->prepare($update);
					$mysql->bindValue(':email', $email);
					$mysql->bindValue(':token_password', '');
					$mysql->execute();
				}
				// UPDATE `users` SET `token_password` = 'tt' WHERE `users`.`id` = 1;
				$update = 'UPDATE users SET token_password = :token_password WHERE email = :email';
				$mysql = $db->prepare($update);
				$mysql->bindValue(':email', $email);
				$mysql->bindValue(':token_password', $token_password);
				$mysql->execute();
				if( $mysql->rowCount() == 1 ) {

					$to = $email;
					$from = 'noreply@camagru.fr';
					$subject = 'Reinitialisation mot de passe';
					$message = "
						Bonjour $username,\n
						Cliquez sur le lien suivant pour réinitialiser votre mot de passe :\n
						http://127.0.0.1:8080/camagru/index.php?p=reset_password&t=$token_password
					";

					$headers = "From: $from"; 
					$ok = @mail($to, $subject, $message, $headers, "-f " . $from);
					die( json_encode("success") );
				}
				else
					die( json_encode("Error Code: " . $mysql->errorCode()) );
			}
			else {
				$error[] = 'L\'email n\'existe pas';
				die( json_encode($error) );
			}
		}
		else
			die( json_encode($error) );
	}
	
	if( !empty($_POST['change_password']) ) {

		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		$token_password = $_POST['token'];

		$error = array();

		if( empty($password) || empty($confirm) ) 
			$error[] = "Champs vide";
		// exacte same password or return
		if( $password !== $confirm)
			$error[] = "Les mots de passe ne match pas";
		if( strlen($password) < 8 || strlen($confirm) < 8 )
			$error[] = "Password trop petit ( 8 caracteres min )";
			
		if( empty($error) ) {

			$sql = 'SELECT * FROM users WHERE token_password = :token_password';
			$mysql = $db->prepare($sql);
			$mysql->bindValue(':token_password', $token_password);
			$mysql->execute();

			$result = $mysql->fetchAll( PDO::FETCH_ASSOC );

			if( !empty($result) ) {

				$new_password = hash('whirlpool', $password);

				// UPDATE `users` SET `token_password` = 'tt' WHERE `users`.`id` = 1;
				$update = 'UPDATE users SET password = :password WHERE token_password = :token_password';
				$mysql = $db->prepare($update);
				$mysql->bindValue(':password', $new_password);
				$mysql->bindValue(':token_password', $token_password);
				$mysql->execute();
				if( $mysql->rowCount() == 1 ) {
					
					$update = 'UPDATE users SET token_password = :reset_token WHERE token_password = :token_password';
					$mysql = $db->prepare($update);
					$mysql->bindValue(':token_password', $token_password);
					$mysql->bindValue(':reset_token', '');
					$mysql->execute();
					
					die( json_encode("success") );
				}
				else
					die( json_encode("Error Code: " . $mysql->errorCode()) );
			}
			else {

				$error[] = 'Mauvais Token';
				die( json_encode($error) );
			}
		}
		else
			die( json_encode($error) );
	}

?>