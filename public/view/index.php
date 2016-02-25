<div class="row">
	<div class="viewer col-12 no-padding-at-xs">
		<h1 class="text-uppercase">Bienvenue</h1>
		<div class="galerie col-12">
		<?php
			$i = 0;
			$page = 0;
			$imgs = getAllUsersImgs();
			$count = sizeof($imgs);
			echo '<div class="page-container col-12">';
			while( $i < $count ) {
				if( $i % 11 == 1 && $i != 1 ) {
					echo '</div>';
					echo '<div class="page-container-count col-12"><span class="page-left" onclick="pageLeft(this)"><</span>' . $page . '<span class="page-right" onclick="pageRight(this)">></span></div>';
					echo '<div class="page-container col-12">';
					echo '<div class="col-3 col-xs-6">
							<img onclick="imgInfo(this)" class="galerie-img" src="private/galerie/' 
								. $imgs[$i]['name']. '.png" 
								data-id="'. $imgs[$i]['id'] .'">
						</div>
					';
					$page++;
				}
				else {
					echo '<div class="col-3 col-xs-6">
							<img onclick="imgInfo(this)" class="galerie-img" src="private/galerie/' 
								. $imgs[$i]['name']. '.png" 
								data-id="'. $imgs[$i]['id'] .'">
						</div>
					';	
				}
				$i++;
			}
			echo '</div>';
			echo '<div class="page-container-count col-12"><span class="page-left" onclick="pageLeft(this)"><</span>' . $page . '<span class="page-right" onclick="pageRight(this)">></span></div>';
		?>
		</div>
	</div>
</div>
<div id="modal">
	<span class="icon delete-icon text-red modal-dismiss" onclick="hideModal()"></span>
	<div class="modal-box">
		<img class="modal-preview-img" src="">
		<div class="likes"></div>
		<div class="comments"></div>
	</div>
</div>
<script src="public/js/galerie.js" type="text/javascript"></script>
