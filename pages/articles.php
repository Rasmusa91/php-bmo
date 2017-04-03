<?php
	if(empty($currentSubpage)) {
		include("allArticles.php");
	}
	else {
		$article = GetArticle($currentSubpage);
		
		if(!empty($article)) {
			include("articleSingle.php");
		}
		else {
			include("articleSingleError.php");
		}
	}
?>