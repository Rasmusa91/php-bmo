<?php
	$objectID = ((isset($_POST["removeObjectID"]) && $_POST["removeObjectID"] != -1) ? $_POST["removeObjectID"] : "");
	
	if(isset($_POST["removeObjectSubmit"]))
	{
		$errorMessage = "";
		
		if(!empty($objectID)) 
		{
			RemoveObject(intval($objectID));
			$successMessage = "Du har tagit bort ett objekt!";
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
		<select name = "removeObjectID" OnChange = "submit();">
			<option value = "-1">Väl objekt...</option>
			<?php foreach($existingObjects as $object): ?>
				<option value = "<?= $object["id"]; ?>" <?= ($objectID == $object["id"] ? "selected" : "") ?>><?= $object["title"]; ?></option>
			<?php endforeach; ?>
		</select>
	</p>
</form>

<form method = "post">
	<input hidden name = "removeObjectID" value = "<?= $objectID; ?>">
	
	<p>
		<input name = "removeObjectSubmit" class = "button" type = "submit" value = "Ta bort" <?= (empty($objectID) ? "disabled" : ""); ?>>
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