<?php
	$currentArticleID = (isset($_POST["articleID"]) ? $_POST["articleID"] : "-1");
	$currentObjectID = (isset($_POST["objectID"]) ? $_POST["objectID"] : "-1");
	$currentObjectCategory = (isset($_POST["objectCategory"]) ? $_POST["objectCategory"] : "-1");
	$currentRadiobutton =  (isset($_POST["singleOrCat"]) ? $_POST["singleOrCat"] : "");
		
	if(isset($_POST["removeRelation"]))
	{
		if(empty($currentRadiobutton) || $currentRadiobutton == "objectSingle") {
			RemoveRelationSingle(intval($currentArticleID), intval($currentObjectID));
		}
		else {
			RemoveRelationsByCategory(intval($currentArticleID), $currentObjectCategory);
		}
		
		$successMessage = "Du har tagit bort en eller flera relationer!";
	}
	
	if(isset($_POST["removeAllRelations"]))
	{
		RemoveRelationsAll(intval($currentArticleID));
		$successMessage = "Du har tagit bort alla relaterade objekt för den här artikeln!";
	}	
	
	$existingArticles = GetArticlesWithRelations();
	$existingObjects = GetRelatedObjects($currentArticleID);
	$existingObjectCategories = GetRelatedObjectCategories($currentArticleID);
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<h3>
		Artikel
	</h3>

	<p class = "noSpaces">
		<select name = "articleID" OnChange = "submit();">
			<option value = "-1">Väl artikel...</option>
			<?php foreach($existingArticles as $article): ?>
				<option value = "<?= $article["id"]; ?>" <?= ($currentArticleID == $article["id"] ? "selected" : ""); ?>><?= $article["title"]; ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<h3>
		Objekt
	</h3>

	<p class = "noSpaces">
		<p class = "noSpaces left">
			<select name = "objectID" OnChange = "submit();" <?= ($currentArticleID == -1 || $currentRadiobutton == "objectCat" ? "disabled" : ""); ?>>
				<option value = "-1">Väl objekt...</option>
				<?php foreach($existingObjects as $object): ?>
					<option value = "<?= $object["id"]; ?>" <?= ($currentObjectID == $object["id"] ? "selected" : ""); ?>><?= $object["title"]; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p class = "noSpaces left">
			<input class = "radioButton" type = "radio" name = "singleOrCat" value = "objectSingle" <?= (empty($currentRadiobutton) || $currentRadiobutton == "objectSingle" ? "checked" : ""); ?> OnChange = "submit();">
		</p>
		
		<div class = "clear"></div>
	</p>

	<h4>
		eller
	</h4>

	<h3>
		Objektkategorier
	</h3>

	<p class = "noSpaces">
		<p class = "noSpaces left">
			<select name = "objectCategory" OnChange = "submit();" <?= ($currentArticleID == -1 || empty($currentRadiobutton) || $currentRadiobutton == "objectSingle" ? "disabled" : ""); ?>>
				<option value = "-1">Väl objekt...</option>
				<?php foreach($existingObjectCategories as $cats): ?>
					<option value = "<?= $cats["category"]; ?>" <?= ($currentObjectCategory == $cats["category"] ? "selected" : ""); ?>><?= $cats["category"]; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p class = "noSpaces left">
			<input class = "radioButton" type = "radio" name = "singleOrCat" value = "objectCat" <?= ($currentRadiobutton == "objectCat" ? "checked" : ""); ?> OnChange = "submit();">
		</p>
		
		<div class = "clear"></div>
	</p>

	<p>
		<input name = "removeRelation" class = "button" type = "submit" value = "Ta bort" <?= (($currentArticleID == -1) || ($currentObjectID == -1 && $currentObjectCategory == -1) ? "disabled" : ""); ?>>
		<input name = "removeAllRelations" class = "button" type = "submit" value = "Ta bort alla" <?= (($currentArticleID == -1) ? "disabled" : ""); ?>>
	</p>	
</form>

<?php if(isset($successMessage) && !empty($successMessage)): ?>
<p>
	<?= $successMessage; ?>
</p>
<?php endif; ?>