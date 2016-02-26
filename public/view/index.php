<div class="row">
	<div class="viewer col-12 no-padding-at-xs">
		<h1 class="text-uppercase">Bienvenue</h1>
		<div class="galerie col-12">
		<?php
			$imgs = getAllUsersImgs();
			if( !empty($imgs) ) {
				$i = 0;
				$page = 0;
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
			}
		?>
		</div>
	</div>
</div>
<div id="modal">
	<div class="row">
		<div class="col-12 no-padding-at-all"></div>
			<span id="modal-dismiss" class="icon delete-icon text-red" onclick="hideModal()"></span>
		</div>
		<div class="col-12 no-padding-at-xs">
			<div id="modal-box row">
				<div class="col-12">
					<div id="tumbnail-img" class="no-padding-at-all">	
						<img id="modal-preview-img" src="" data-id="">
						<div id="img-infos">
							<div class="col-4 no-padding-at-all">
								<span class="pull-left"><span id="like-number">0</span> Like(s)</span>
								<?php 
									if( is_log() ) { 
										echo '<span id="like-img-btn" onclick="likeImg()" class="icon like-icon"></span>';
									}
								?>
							</div>
							<div class="col-8 no-padding-at-all">
								<?php
									if( is_log() ) {
										echo '<input onkeydown="commentImg(this)" id="comment-input" type="text" placeholder="Ajouter un com ! (140 max)" value="" maxlength="140">';
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div id="comments">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="public/js/galerie.js" type="text/javascript"></script>
