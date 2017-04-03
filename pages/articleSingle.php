<div id = "articleSingle">
	<h1><?= $article["title"] ?></h1>

	<div class = "articleAuthor">
		<?= $article["author"]; ?>, <?= $article["pubdate"]; ?>
	</div>
	<div class = "articleContent">
		<?= $article["content"]; ?>
	</div>
		
	<div class = "clear"></div>

	<div id = "articleSingleRelatedObjects">
		<?php
			$objects = GetRelatedObjects(intval($currentSubpage));
		?>

		<?php if(!empty($objects)): ?>
			<h2>Relaterade objekt</h2>
			<?php for($i = 0; $i < count($objects); $i++): ?>
				<div class = "galleryPreviewWrapper <?= (($i + 1) % 4 == 0 ? "galleryPreviewNoMargin" : ""); ?>">
					<div class = "galleryPreview">	
						<a href = "?p=gallery&subp=<?= $objects[$i]["id"]; ?>"><img src = "<?= GetImagePath($objects[$i]["image"], 150); ?>"></a>
					</div>
				</div>	
			<?php endfor; ?>
		<?php endif; ?>

		<div class = "clear"></div>
	</div>
	
	<div class = "nextObjectArticle">
		<?php 
		$article = GetNextArticle($currentSubpage, -1);
		if(!empty($article)): ?>
			<div class = "left">
				<h3>Föregående artikel</h3>
				<a href = "?p=articles&subp=<?= $article["id"]?>"><?= $article["title"]; ?></a>
			</div>
		<?php endif; ?>	
		
		<?php 
		$article = GetNextArticle($currentSubpage, 1);
		if(!empty($article)): ?>
		<div class = "right textRight">
			<h3>Nästa artikel</h3>
			<a href = "?p=articles&subp=<?= $article["id"]?>"><?= $article["title"]; ?></a>
		</div>
		<?php endif; ?>	
		
		<div class = "clear"></div>
	</div>
</div>