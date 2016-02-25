<?php

	include_once '../config/loader.php';

	if( !empty($_POST['get_info_img']) ) {


		$img_id = $_POST['img_id'];
		if( !is_numeric($img_id) )
			die( json_encode('error img') );
		$user_id = $_SESSION['user_id'];
	    
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

	    	$likes = '
	    		SELECT count(user_id) as total, 
	    			(
	    				SELECT count(user_id)
	    				FROM likes
	    				WHERE img_id = :img_id AND user_id = :user_id
	    			) as is_liked
		    	FROM likes
		    	WHERE img_id = :img_id';
			$mysql = $db->prepare($likes);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$mysql->execute();

	    	$imgLikes = $mysql->fetchAll( PDO::FETCH_ASSOC )[0];

	    	$comments = 'SELECT count(*) FROM comments WHERE img_id = :img_id';
			$mysql = $db->prepare($comments);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->execute();

	    	$imgcomments = $mysql->fetchAll( PDO::FETCH_ASSOC );

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

	/*
	**	add a like to an img
	**	max 140 chars
	*/
	if( !empty($_POST['post_like']) ) {

		$img_id = $_POST['img_id'];
		$user_id = $_SESSION['user_id'];

		if( !is_numeric($img_id) )
			die( json_encode('error img') );

	    $like = 'SELECT id FROM likes WHERE img_id = :img_id AND user_id = :user_id';
		$mysql = $db->prepare($like);
		$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
		$mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$mysql->execute();

    	if( empty($mysql->fetchAll( PDO::FETCH_ASSOC )[0]) ) {
			
			$insert = 'INSERT INTO likes (id, img_id, user_id) VALUES ("", :img_id, :user_id)';
			$mysql = $db->prepare($insert);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$mysql->execute();
			if( $mysql->rowCount() == 1 )
				die( json_encode('success') );
    	}
    	else {

    		$delete = 'DELETE FROM likes WHERE img_id = :img_id AND user_id = :user_id';
			$mysql = $db->prepare($delete);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$mysql->execute();
			if( $mysql->rowCount() == 1 )
				die( json_encode('success') );
    	}
	}
	/*
	**	add comment on img
	**	max 140 chars
	*/
	if( !empty($_POST['post_com']) ) {
		
	}