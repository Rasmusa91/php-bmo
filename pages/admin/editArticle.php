<?php
	$articleID = ((isset($_POST["editArticleArticle"]) && $_POST["editArticleArticle"] != -1) ? $_POST["editArticleArticle"] : "");
	
	if(isset($_POST["editArticleSubmit"]))
	{
		$errorMessage = "";
		
		if(!empty($articleID)) 
		{
			$title = (isset($_POST["editArticleTitle"]) ? $_POST["editArticleTitle"] : "");
			$author = (isset($_POST["editArticleAuthor"]) ? $_POST["editArticleAuthor"] : "");
			$category = (isset($_POST["editArticleCategory"]) ? $_POST["editArticleCategory"] : "");
			$content = (isset($_POST["editArticleContent"]) ? $_POST["editArticleContent"] : "");
			
			if(empty($title)) {
				$errorMessage .= "<p>* Titeln får inte vara tom</p>";
			}
			
			if(empty($author)) {
				$errorMessage .= "<p>* Författaren får inte vara tom</p>";
			}

			if(empty($category)) {
				$errorMessage .= "<p>* Kategorin får inte vara tom</p>";
			}

			if(empty($content)) {
				$errorMessage .= "<p>* Innehållet får inte vara tomt</p>";
			}		
			
			if(empty($errorMessage)) {
				EditArticle(intval($articleID), $title, $author, $category, $content);
				$successMessage = "Du har ändrat en artikel!";
			}
		}
		else {
			$errorMessage .= "<p>* Välj en artikel!</p>";
		}
	}
	
	$existingArticles = GetArticles();
	$selectedArticle = GetArticle($articleID);
?>

<form method = "post">
	<h3>
		Artikel
	</h3>
	
	<p class = "noSpaces">
		<select name = "editArticleArticle" OnChange = "submit();">
			<option value = "-1">Väl artikel...</option>
			<?php foreach($existingArticles as $article): ?>
				<option value = "<?= $article["id"]; ?>" <?= ($articleID == $article["id"] ? "selected" : "") ?>><?= $article["title"]; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
</form>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<input hidden name = "editArticleArticle" value = "<?= $articleID; ?>">
	
	<h3>
		Titel
	</h3>
	<p class = "noSpaces">
		<input name = "editArticleTitle" value = "<?= $selectedArticle["title"]; ?>" <?= (empty($articleID) ? "disabled" : ""); ?>>
	</p>
	
	<h3>
		Författare
	</h3>
	<p class = "noSpaces">
		<input name = "editArticleAuthor" value = "<?= $selectedArticle["author"]; ?>" <?= (empty($articleID) ? "disabled" : ""); ?>>
	</p>
	
	<h3>
		Kategori
	</h3>
	<p class = "noSpaces">
		<input name = "editArticleCategory" value = "<?= $selectedArticle["category"]; ?>" <?= (empty($articleID) ? "disabled" : ""); ?>>
	</p>
	
	<h3>
		Innehåll
	</h3>	
	<p>
		<textarea name = "editArticleContent" <?= (empty($articleID) ? "disabled" : ""); ?>><?= $selectedArticle["content"]; ?></textarea>
	</p>
	
	<p>
		<input name = "editArticleSubmit" class = "button" type = "submit" value = "Ändra" <?= (empty($articleID) ? "disabled" : ""); ?>>
	</p>	
</form>

<?php if(isset($successMessage) && !empty($successMessage)): ?>
<p>
	<?= $successMessage; ?>
</p>
<?php endif; ?>

<?php if(isset($errorMessage) && !empty($errorMessage)): ?>
<div class = "formErrors">
	<?= $errorMessage; ?>
</div>
<?php endif; ?>