<?php 
	if( !empty($_SESSION['user']) ) {
		echo '
			<div class="header-container">
				<ul class="text-left pull-left">
					<li><h1 class="no-margin">CAMAGRU</h1></li>
				</ul>
				<ul class="list-inline text-right pull-right header-list">
					<li>
						<a href="?p=index">Galerie</a>
					</li>
					<li class="separator">&nbsp;|&nbsp;</li>
					<li>
						<a href="?p=montage">Montage</a>
					</li>
					<li class="separator">&nbsp;|&nbsp;</li>
					<li>
						<span class="icon logout-icon text-red btn-logout"></span>
					</li>
				</ul>
			</div>
		';	
	}
	else {
?>
<div class="header-container">
	<ul class="text-left pull-left">
		<li><h1 class="no-margin">CAMAGRU</h1></li>
	</ul>
	<ul class="list-inline text-right pull-right header-list">
		<li class="text-uppercase">
			<a href="?p=inscription">inscription</a>
		</li>
		<li class="separator">&nbsp;|&nbsp;</li>
		<li class="text-uppercase">
			<a href="?p=connexion">connexion</a>
		</li>
	</ul>
</div>
<?php
	}
?>