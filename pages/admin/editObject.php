<?php
	$objectID = ((isset($_POST["editObjectObject"]) && $_POST["editObjectObject"] != -1) ? $_POST["editObjectObject"] : "");
	
	if(isset($_POST["editObjectSubmit"]))
	{
		$errorMessage = "";
		
		if(!empty($objectID)) 
		{
			$title = (isset($_POST["editObjectTitle"]) ? $_POST["editObjectTitle"] : "");
			$owner = (isset($_POST["editObjectOwner"]) ? $_POST["editObjectOwner"] : "");
			$category = (isset($_POST["editObjectCategory"]) ? $_POST["editObjectCategory"] : "");
			$description = (isset($_POST["editObjectDescription"]) ? $_POST["editObjectDescription"] : "");
			$image = (isset($_POST["editObjectImage"]) ? $_POST["editObjectImage"] : "");
			
			if(empty($title)) {
				$errorMessage .= "<p>* Titeln får inte vara tom</p>";
			}
			
			if(empty($owner)) {
				$errorMessage .= "<p>* Ägaren får inte vara tom</p>";
			}

			if(empty($category)) {
				$errorMessage .= "<p>* Kategorin får inte vara tom</p>";
			}
			
			if(empty($image)) {
				$errorMessage .= "<p>* Bilden får inte vara tomt</p>";
			}	

			if(empty($description)) {
				$errorMessage .= "<p>* Beskrivningen får inte vara tomt</p>";
			}		
			
			if(empty($errorMessage)) {
				EditObject(intval($objectID), $title, $owner, $category, $image, $description);
				$successMessage = "Du har ändrat ett objekt!";
			}
		}
		else {
			$errorMessage .= "<p>* Välj ett objekt!</p>";
		}
	}
	
	$existingObjects = GetObjects();
	$selectedObject = GetObject($objectID);
?>

<form method = "post">
	<h3>
		Objekt
	</h3>
	
	<p class = "noSpaces">
		<select name = "editObjectObject" OnChange = "submit();">
			<option value = "-1">Väl objekt...</option>
			<?php foreach($existingObjects as $object): ?>
				<option value = "<?= $object["id"]; ?>" <?= ($objectID == $object["id"] ? "selected" : "") ?>><?= $object["title"]; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
</form>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<input hidden name = "editObjectObject" value = "<?= $objectID; ?>">
	
	<h3>
		Titel
	</h3>
	<p class = "noSpaces">
		<input name = "editObjectTitle" value = "<?= $selectedObject["title"]; ?>" <?= (empty($objectID) ? "disabled" : ""); ?>>
	<p>
	
	<h3>
		Ägare
	</h3>
	<p class = "noSpaces">
		<input name = "editObjectOwner" value = "<?= $selectedObject["owner"]; ?>" <?= (empty($objectID) ? "disabled" : ""); ?>>
	<p>
	
	<h3>
		Kategori
	</h3>
	<p class = "noSpaces">
		<input name = "editObjectCategory" value = "<?= $selectedObject["category"]; ?>" <?= (empty($objectID) ? "disabled" : ""); ?>>
	<p>
	
	<h3>
		Bild
	</h3>	
	<p>
		<input name = "editObjectImage" <?= (empty($objectID) ? "disabled" : ""); ?> value = "<?= $selectedObject["image"]; ?>">
	</p>
	
	<h3>
		Beskrivning
	</h3>	
	<p>
		<input name = "editObjectDescription" <?= (empty($objectID) ? "disabled" : ""); ?> value = "<?= $selectedObject["text"]; ?>">
	</p>
	
	<p>
		<input name = "editObjectSubmit" class = "button" type = "submit" value = "Ändra" <?= (empty($objectID) ? "disabled" : ""); ?>>
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