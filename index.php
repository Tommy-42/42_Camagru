<?php
	include_once 'config/loader.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Camagru">
<meta name="author" content="Tommy PAGEARD">
<link rel="icon" href="public/img/fav.ico">

<title>Bienvenue</title>

<!-- Custom styles for this template -->
<link href="public/css/main.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div class="header">
		<?php include_once 'private/header.php' ?>
	</div>
    <div class="container">
    	<div class="viewer">
    	<?php include_once 'private/rooting.php' ?>
    	</div>
    </div> <!-- /container -->
</body>
</html>
