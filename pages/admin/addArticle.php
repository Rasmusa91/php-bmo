<?php
	if(isset($_POST["addArticleSubmit"]))
	{
		$errorMessage = "";
		
		$title = (isset($_POST["newArticleTitle"]) ? $_POST["newArticleTitle"] : "");
		$author = (isset($_POST["newArticleAuthor"]) ? $_POST["newArticleAuthor"] : "");
		$category = (isset($_POST["newArticleCategory"]) ? $_POST["newArticleCategory"] : "");
		$content = (isset($_POST["newArticleContent"]) ? $_POST["newArticleContent"] : "");
		
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
			AddArticle($title, $author, $category, $content);
			$successMessage = "Du har lagt till en artikel!";
		}
	}
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<h3>
		Titel
	</h3>
	<p class = "noSpaces">
		<input name = "newArticleTitle">
	</p>
	
	<h3>
		Författare
	</h3>
	<p class = "noSpaces">
		<input name = "newArticleAuthor">
	</p>
	
	<h3>
		Kategori
	</h3>
	<p class = "noSpaces">
		<input name = "newArticleCategory">
	</p>
	
	<h3>
		Innehåll
	</h3>	
	<p>
		<textarea name = "newArticleContent"></textarea>
	</p>
	
	<p>
		<input name = "addArticleSubmit" class = "button" type = "submit" value = "Lägg till">
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