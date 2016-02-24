<div class="row">
	<div class="col-12 no-padding-at-xs">
		<div class="col-8 no-padding-at-xs">
			<div class="viewer col-12">
				<h1>Montage</h1>
				<p>choisissez un filtre, prenez votre photo et ensuite enregistez la !</p>
				<p class="p-error"></p>
				<p class="p-success"></p>
				<div class="pool-img col-12">
				<?php

					$filters = array_diff(scandir($path . '/public/img/pool/'), array('..', '.', '.DS_Store'));
					$filters = array_values($filters);
					foreach ($filters as $key => $filter) {
						echo '
							<img
								class="preview-filter"
								onclick="chooseFilter(this)"
								src="public/img/pool/'.$filter.'"
							>
						';
					}
				?>
				</div>
				<div class="render col-12">
					<div class="render-preview">
						<div class="render-filter">
						</div>
						<div class="camera">
							<video id="video">Video stream not available.</video>
							<button class="btn btn-success" id="startbutton">Prendre la Photo</button> 
						</div>
					</div>
					<div id="output">
						<canvas id="canvas">
						</canvas>
						<img id="photo" alt="The screen capture will appear in this box."> 
						<img id="userPic">
						<button class="btn btn-primary" id="saveButton">Enregistrer</button> 
					</div>
				</div>
			</div>
		</div>
		<div class="col-4 no-padding-at-xs">
			<div class="viewer col-12">
				<h1>Recap</h1>
				<div id="recap" class="row">
				<?php
					$lastImgs = getUserImgs(0, 0, 'id DESC');

					foreach ($lastImgs as $key => $img) {
						echo '<div class="recap-img-div col-12 no-padding-at-all">';
						echo '
							<img
								class="recap-img"
								src="private/galerie/'.$img['name'].'.png"
							>
						';
						echo '<input type="hidden" class="img-id" value="'. $img['id'] .'">';
						echo '<span class="icon delete-icon text-red btn-delete-img" onclick="removeImg(this)"></span>';
						echo '</div>';
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="public/js/montage.js" type="text/javascript"></script>