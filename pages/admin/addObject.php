<?php
	if(isset($_POST["addObjectSubmit"]))
	{
		$errorMessage = "";
		
		$title = (isset($_POST["newObjectTitle"]) ? $_POST["newObjectTitle"] : "");
		$owner = (isset($_POST["newObjectOwner"]) ? $_POST["newObjectOwner"] : "");
		$category = (isset($_POST["newObjectCategory"]) ? $_POST["newObjectCategory"] : "");
		$image = (isset($_POST["newObjectImage"]) ? $_POST["newObjectImage"] : "");
		$description = (isset($_POST["newObjectDescription"]) ? $_POST["newObjectDescription"] : "");
		
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
			$errorMessage .= "<p>* Bilden får inte vara tom</p>";
		}
		
		if(empty($description)) {
			$errorMessage .= "<p>* Beskrivningen får inte vara tom</p>";
		}		
		
		if(empty($errorMessage)) {
			AddObject($title, $owner, $category, $image, $description);
			$successMessage = "Du har lagt till ett objekt!";
		}
	}
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<h3>
		Titel
	</h3>
	<p class = "noSpaces">
		<input name = "newObjectTitle">
	</p>
	
	<h3>
		Ägare
	</h3>
	<p class = "noSpaces">
		<input name = "newObjectOwner">
	</p>
	
	<h3>
		Kategori
	</h3>
	<p class = "noSpaces">
		<input name = "newObjectCategory">
	</p>
	
	<h3>
		Bild
	</h3>
	<p class = "noSpaces">
		<input name = "newObjectImage">
	</p>
	
	<h3>
		Beskrivning
	</h3>	
	<p>
		<input name = "newObjectDescription">
	</p>
	
	<p>
		<input name = "addObjectSubmit" class = "button" type = "submit" value = "Lägg till">
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