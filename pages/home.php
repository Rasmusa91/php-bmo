<div id = "homeContent">
	<div id = "homeContent">
		<h1>Välkommen</h1>
		<?= GetHomePageDescription(); ?>
	</div>

	<div id = "homeArticles">
		<h1>Artiklar</h1>
		
		<?php 
		$articles = GetArticles(intval(GetHomeArticleAmount()), GetHomeArticleRelevancy());
		foreach ($articles as $article): 
		?>
		<div class = "articleTitle">
			<?= $article["title"]; ?>
		</div>
		<div class = "articleContent">
			<?php
				$content = strip_tags($article["content"]);

				$substrAmount = 200;
				if(strlen($content) > $substrAmount){
					$content = substr($content, 0, strpos($content, " ", $substrAmount)) . "...";
				}
				
				echo $content; 			
			?>
		</div>
		<div class = "articleView">
			<a href = "?p=articles&subp=<?= $article["id"]; ?>">Visa hela artikeln</a>
		</div>
		<div class = "clear"></div>
		<?php 
		endforeach; 
		?>
	</div>
	
	<div id = "homeObjects">
		<h1>Objekt</h1>

		<?php 
		$objects = GetObjects(intval(GetHomeObjectAmount()));

		for($i = 0; $i < count($objects); $i++): ?>
			<div class = "galleryPreviewWrapper <?= (($i + 1) % 4 == 0 ? "galleryPreviewNoMargin" : ""); ?>">
				<div class = "galleryPreview">	
					<a href = "?p=gallery&subp=<?= $objects[$i]["id"]; ?>"><img src = "<?= GetImagePath($objects[$i]["image"], 150); ?>"></a>
				</div>
			</div>	
		<?php 
		endfor; 
		?>

		<div class = "clear"></div>
	</div>
</div>