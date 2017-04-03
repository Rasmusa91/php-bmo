<?php
	$articles = GetArticles();
?>

<h1>Begravningsmuseet artiklar</h1>

<?php foreach ($articles as $article): ?>
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
<?php endforeach; ?>
