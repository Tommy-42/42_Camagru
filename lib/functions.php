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

?>