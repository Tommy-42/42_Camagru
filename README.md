# Camagru
## Projet Web | Tier I | Ecole 42
### Consigne:<br>
*Vous n’avez pas le droit d’utiliser de framework, micro-framework, librairies ou quoi
que ce soit provenant du monde extérieur (excepté les polices de caractères), aussi bien
pour le serveur que pour le client, donc pas de Bootstrap, pas de jQuery, pas de Symfony
etc... Seules les extensions instalées sur PHP (GD et les drivers SGBD, entre autres), ainsi
que les API javascript natives de vos navigateurs sont autorisées.
Vous devez utiliser l’interface d’abstraction PDO pour acceder à votre base de données,
et définir le mode d’erreur sur PDO::ERRMODE_EXCEPTION.*

## Résumé
Petite application web permettant de réaliser des montages basiques à l’aide de votre webcam et d’images prédéfinies.
<br>
Une partie Galerie des montages avec Commentaires et Likes possible des membres.

## READY
1. PARTIE UTILISATEUR
	* Inscription avec mail de confirmation ( Ajax )
	* Securisation mot de passe ( 1 chiffre min )
	* Connection ( Ajax )
	* Mail de reinitialisation mot de passe ( Ajax )
	* Deconnection ( Ajax )
2. PARTIE MONTAGE
	* Section principale
		* Apercu Webcam
		* Liste des images superposables
		* Bouton pour prendre la photo
		* Preview Final avec filter
		* Save Picture
	* Section laterale
		* Miniatures photos prises precedement
		* Possibilite de supprimer les montages
3. PARTIE GALERIE
	* Affichage de tout les montages de chaque membres ( pagination infinie )
	* Like images galerie si connecté
	* Commentaires des montages si connecté
	* Lorsque Commentaires sur un montage, notif email a l'auteur
4. PARTIE SQL
	* USERS / COMMENTS / LIKES / MONTAGES 100%

## TODO
1. PARTIE UTILISATEUR
2. PARTIE MONTAGE
3. PARTIE GALERIE
4. PARTIE SQL