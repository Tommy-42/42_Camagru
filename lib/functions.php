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
?>