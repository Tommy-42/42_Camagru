<div class="row">
	<div class="col-12">
		<div class="col-8">
			<div class="viewer col-12">
				<h1>Montage</h1>
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
		<div class="col-4">
			<div class="viewer col-12">
				<h1>Recap</h1>
				<div id="recap" class="row">
				<?php
					$lastImgs = getUserImgs(0, 5);

					foreach ($lastImgs as $key => $img) {
						echo '<div class="col-12">';
						echo '
							<img
								class="recap-img"
								src="private/galerie/'.$img['name'].'.png"
							>
						';
						echo '</div>';
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="public/js/montage.js" type="text/javascript"></script>