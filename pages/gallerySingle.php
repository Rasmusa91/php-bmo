<h1><?= $object["title"] ?></h1>

<div class = "objectOwner">
	Ägare av detta objekt är <b><?= $object["owner"]; ?></b>
</div>

<div class = "objectImageWrapper">
	<div class = "objectImage">
		<a href = "<?= $object["image"]; ?>"><img src = "<?= GetImagePath($object["image"], 700); ?>"></a>
	</div>
</div>

<?php
	$objects = GetCloseObjects(intval($currentSubpage));
	if(!empty($objects)): ?>
	<?php for($i = 0; $i < count($objects); $i++): ?>
		<div class = "galleryPreviewWrapper <?= (($i + 1) % 4 == 0 ? "galleryPreviewNoMargin" : ""); ?>">
			<div class = "galleryPreview">	
				<a href = "?p=gallery&subp=<?= $objects[$i]["id"]; ?>"><img src = "<?= GetImagePath($objects[$i]["image"], 150); ?>"></a>
			</div>
		</div>	
	<?php endfor; ?>
	
	<div class = "clear"></div>
<?php endif; ?>

<div id = "gallerySingleRelatedObjects">
	<?php
		$articles = GetRelatedArticles(intval($currentSubpage));
		if(!empty($articles)):
	?>
			<h2>Relaterade artiklar</h2>
	<?php	
			foreach ($articles as $article):
	?>
				<div class = "articleTitle">
					<?= $article["title"]; ?>
				</div>
				<div class = "articleAuthor">
					<?= $article["author"]; ?>, <?= $article["pubdate"]; ?>
				</div>
				<div class = "articleContent">
					<?php
						$content = strip_tags($article["content"]);

						$substrAmount = 300;
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
		endif;
	?>
</div>