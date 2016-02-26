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

	    	$comments = '
	    		SELECT c.comment, u.username
	    		FROM comments as c
	    		LEFT JOIN users as u ON( u.id = c.user_id )
	    		WHERE img_id = :img_id';
			$mysql = $db->prepare($comments);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->execute();

	    	$imgComments = $mysql->fetchAll( PDO::FETCH_ASSOC );

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

	if( !empty($_POST['get_comments']) ) {
		
		$img_id = $_POST['img_id'];
		if( !is_numeric($img_id) )
			die( json_encode('error img') );

		$comments = '
    		SELECT c.comment, u.username
    		FROM comments as c
    		LEFT JOIN users as u ON( u.id = c.user_id )
    		WHERE img_id = :img_id';
		$mysql = $db->prepare($comments);
		$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
		$mysql->execute();

    	$imgComments = $mysql->fetchAll( PDO::FETCH_ASSOC );

    	$result = array(
    		'success' => array(
	    		'comments' => $imgComments
	    	)
    	);
		die( json_encode($result) );
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
	if( !empty($_POST['post_comment']) ) {
		
		$img_id = $_POST['img_id'];
		$user_id = $_SESSION['user_id'];
		$comment = strip_tags($_POST['comment']);
		if( !is_numeric($img_id) )
			die( json_encode('error img') );
		if( strlen($comment) < 1 || strlen($comment) > 140 )
			die( json_encode('error msg too long') );

	    $img = 'SELECT id FROM images WHERE img_id = :img_id';
		$mysql = $db->prepare($like);
		$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
		$mysql->execute();

    	if( empty($mysql->fetchAll( PDO::FETCH_ASSOC )[0]) ) {
			
			$insert = 'INSERT INTO comments (id, comment, img_id, user_id) VALUES ("", :comment, :img_id, :user_id)';
			$mysql = $db->prepare($insert);
			$mysql->bindValue(':comment', $comment);
			$mysql->bindValue(':img_id', $img_id, PDO::PARAM_INT);
			$mysql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$mysql->execute();
			if( $mysql->rowCount() == 1 )
				die( json_encode('success') );
    	}
	}