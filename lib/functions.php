<?php

function d( $var, $die = true ) {
	echo '<pre style="text-align: left">';
	print_r( $var );
	echo '</pre>';

	if( $die ) die;
}

function is_log() {
	if( !empty($_SESSION['user']) && !empty($_SESSION['email']) )
		return TRUE;
	else
		return FALSE;
}

function check_base64_image($base64) {

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

function generateRandomString($length = 10) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = 36;
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
**  Get Images of users
** @param ressource $db DB ressource
** @param int $user_id User_id if 0 get current log user
** @param int $limit limit number of imgs get
*/
function getUserImgs($user_id = 0, $limit = 0) {
   
    global $db;

    if( $user_id == 0 )
        $user_id = $_SESSION['user_id'];

    if( $limit == 0 ) {

        $sql = 'SELECT * FROM images WHERE user_id = :user_id';
        $mysql = $db->prepare($sql);
        $mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    }
    else {
    
        $sql = 'SELECT * FROM images WHERE user_id = :user_id LIMIT :l';
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

?>