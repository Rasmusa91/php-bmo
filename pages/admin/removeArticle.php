<?php
	$articleID = ((isset($_POST["removeArticleID"]) && $_POST["removeArticleID"] != -1) ? $_POST["removeArticleID"] : "");
	
	if(isset($_POST["removeArticleSubmit"]))
	{
		$errorMessage = "";
		
		if(!empty($articleID)) 
		{
			RemoveArticle(intval($articleID));
			$successMessage = "Du har tagit bort en artikel!";
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
		<select name = "removeArticleID" OnChange = "submit();">
			<option value = "-1">Väl artikel...</option>
			<?php foreach($existingArticles as $article): ?>
				<option value = "<?= $article["id"]; ?>" <?= ($articleID == $article["id"] ? "selected" : "") ?>><?= $article["title"]; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
</form>

<form method = "post">
	<input hidden name = "removeArticleID" value = "<?= $articleID; ?>">
	
	<p>
		<input name = "removeArticleSubmit" class = "button" type = "submit" value = "Ta bort" <?= (empty($articleID) ? "disabled" : ""); ?>>
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