<?php
	$searchQuery = (isset($_POST["searchQuery"]) ? $_POST["searchQuery"] : "");
?>

<div id = "searchContent">

<h1>Sökning</h1>

<?php
	if(!empty($searchQuery)):
		$articles = SearchArticles($searchQuery);
		$objects = SearchObjects($searchQuery);
?>
		<b>Söksträng: <?= $searchQuery; ?></b>
<?php
		if(!empty($objects)):
?>
			<h2>Objekt</h2>
<?php 
			for($i = 0; $i < count($objects); $i++): 
?>
				<div class = "galleryPreviewWrapper <?= (($i + 1) % 4 == 0 ? "galleryPreviewNoMargin" : ""); ?>">
					<div class = "galleryPreview">	
						<a href = "?p=gallery&subp=<?= $objects[$i]["id"]; ?>"><img src = "<?= GetImagePath($objects[$i]["image"], 150); ?>"></a>
					</div>
				</div>	
<?php 
			endfor;
?>
		<div class = "clear"></div>
<?php
		endif;
		
		if(!empty($articles)):
?>
			<h2>Artiklar</h2>
			
<?php 
			foreach ($articles as $article): ?>
				<div class = "articleTitle">
					<?= $article["title"]; ?>
				</div>
				<div class = "articleAuthor">
					<?= $article["author"]; ?>, <?= $article["pubdate"]; ?>
				</div>
				<div class = "articleContent">
					<?php
						$content = strip_tags($article["content"]);
						echo substr($content, 0, strpos($content, " ", 300)) . "..."; 
					?>
				</div>
				<div class = "articleView">
					<a href = "?p=articles&subp=<?= $article["id"]; ?>">Visa hela artikeln</a>
				</div>
				<div class = "clear"></div>
<?php 
			endforeach;
?>
			<div class = "clear"></div>
<?php	
		endif;
		
		if(empty($articles) && empty($objects)):
?>
			<h2>Inga resultat hittades</h2>
<?php
		endif;
	else:
?>
	<h2>Ange en valid söksträng</h2>
<?php
	endif;
?>	
</div>