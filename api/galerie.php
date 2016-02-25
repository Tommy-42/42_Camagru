<?php

	include_once '../config/loader.php';

	if( !empty($_POST['get_info_img']) ) {

		$img_id = $_POST['img_id'];
		if( !is_numeric($img_id) )
			die( json_encode('error img') );
	    
	    $img = '
	    	SELECT i.*, u.username 
	    	FROM images as i
	    	LEFT JOIN users as u ON ( i.user_id = u.id )
	    	WHERE i.id = :img_id';
		$mysql = $db->prepare($img);
		$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
		$mysql->execute();

    	$imgInfo = $mysql->fetchAll( PDO::FETCH_ASSOC )[0];

    	if( !empty($imgInfo) ) {

	    	$likes = 'SELECT count(*) as total FROM likes WHERE img_id = :img_id';
			$mysql = $db->prepare($likes);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->execute();

	    	$imgLikes = $mysql->fetchAll( PDO::FETCH_ASSOC )[0];

	    	$comments = 'SELECT count(*) FROM comments WHERE img_id = :img_id';
			$mysql = $db->prepare($comments);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->execute();

	    	$imgcomments = $mysql->fetchAll( PDO::FETCH_ASSOC )[0];

	    	$result = array(
	    		'success' => array(
		    		'infos' => $imgInfo,
		    		'likes' => $imgLikes,
		    		'comments' => $imgComments
		    	)
	    	);
    		die( json_encode($result) );
    	}
	}