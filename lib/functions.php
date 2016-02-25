<?php

/*
** beautiful print_r debug
*/
function d( $var, $die = true ) {
	echo '<pre style="text-align: left">';
	print_r( $var );
	echo '</pre>';

	if( $die ) die;
}

/*
** Check if user is logged or not
*/
function is_log() {
	if( !empty($_SESSION['user']) && !empty($_SESSION['email']) )
		return TRUE;
	else
		return FALSE;
}

/*
** Check the validity of an image base64 encoded
** @param string $base64 base64 encoded img
** return true if real img false if bad one
*/

function check_base64_image( $base64 ) {

    $img = imagecreatefromstring(base64_decode($base64));
    if (!$img) {
        return false;
    }
    $name = hash('whirlpool', 'tmp') . '.png';
    
    imagepng($img, $name);
    $info = getimagesize($name);

    unlink($name);

    if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
        return true;
    }
    return false;
}

/*
** Generate a random string with predifined length
** @param int $length lenght of returned string
*/
function generateRandomString( $length = 10 ) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = 36;
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
** Get all users images
** @param string $order 'table row name[ ]order' to sort result [ASC|DESC]
*/
function getAllUsersImgs( $order = 'id ASC' ) {
   
    global $db;
   
    $sql = 'SELECT * FROM images WHERE 1 ORDER BY ' . $order;
    $mysql = $db->prepare($sql);
    $mysql->execute();

    $result = $mysql->fetchAll( PDO::FETCH_ASSOC );
    if( empty($result) )
        return false;
    return $result;
}

/*
** Get Images of users
** @param int $user_id User_id if 0 get current log user
** @param int $limit limit number of imgs get
** @param string $order 'table row name order' to sort result [ASC|DESC]
*/
function getUserImgs( $user_id = 0, $limit = 0, $order = 'ASC' ) {
   
    global $db;

    if( $user_id == 0 )
        $user_id = $_SESSION['user_id'];

    if( $limit == 0 ) {

        $sql = 'SELECT * FROM images WHERE user_id = :user_id ORDER BY ' . $order;
        $mysql = $db->prepare($sql);
        $mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    }
    else {
    
        $sql = 'SELECT * FROM images WHERE user_id = :user_id LIMIT :l ORDER BY ' . $order;
        $mysql = $db->prepare($sql);
        $mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $mysql->bindValue(':l', $limit, PDO::PARAM_INT);
    }

    $mysql->execute();

    $result = $mysql->fetchAll( PDO::FETCH_ASSOC );
    if( empty($result) )
        return false;
    return $result;
}

/*
** Delete an image from an user
** @param int $user_id User_id if 0 get current log user
** @param int $img_id Id of the image
*/
function deleteUserImg( $user_id = 0, $img_id ) {
   
    global $db;
    global $path;

    if( $user_id == 0 )
        $user_id = $_SESSION['user_id'];

    if( is_numeric($img_id) && $img_id > 0 ) {

        $sql = 'SELECT * FROM images WHERE user_id = :user_id AND id = :img_id';
        $mysql = $db->prepare($sql);
        $mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $mysql->execute();
        $result = $mysql->fetch( PDO::FETCH_ASSOC );

        unlink($path . '/private/galerie/' . $result['name'] . '.png');

        $sql = 'DELETE FROM images WHERE user_id = :user_id AND id = :img_id';
        $mysql = $db->prepare($sql);
        $mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $mysql->execute();

        if( $mysql->rowCount() == 1 ) {
            die( json_encode("success") );
        }
        die( json_encode('Error Code: ' . $mysql->errorCode()) );
    }
    else
        die( json_encode("bad img") );
}

?>