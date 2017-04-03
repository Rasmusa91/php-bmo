<?php
	if(empty($currentSubpage)) {
		include("galleryOverview.php");
	}
	else {
		$object = GetObject($currentSubpage);
		
		if(!empty($object)) {
			include("gallerySingle.php");
		}
		else {
			include("gallerySingleError.php");
		}
	}
?>