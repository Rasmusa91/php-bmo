
	<div id = "popup" <?= ($wantPopup ? "" : "class = \"hidden\"");?>>
		<div id = "popupBackground" OnClick="location.replace(<?php echo "'" . GetURLExtension() . "'"; ?>)">
		</div>
		<div id = "popupContent">
			<a id = "popupClose" href = "<?= GetURLExtension(); ?>">X</a>
			<?php 
				if($wantLogin) {
					include("pages/login.php"); 
				}
			?>
		</div>
	</div>