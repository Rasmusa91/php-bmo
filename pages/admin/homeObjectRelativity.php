<?php
	if(isset($_POST["editHomeObjectRelevancy"]))
	{
		$relevancy = (isset($_POST["homeObjectRelevancy"]) ? $_POST["homeObjectRelevancy"] : "");
		$amount = (isset($_POST["homeObjectAmount"]) ? $_POST["homeObjectAmount"] : "");

		if(is_numeric($amount) && $amount > 0) {
			SetHomeObjectAmount($amount);
			SetHomeObjectRelevancy($relevancy);
			$successMessage = "Du har ändrat relevans för objekten på startsidan";
		}
		else {
			$errorMessage = "* Antalet måste innehålla ett heltal större eller lika med 0";
		}
	}
	
	$options = array(
		"ID" => "id",
		"Titel" => "title",
		"Kategori" => "category",
		"Innehåll" => "text",
		"Bild" => "image",
		"Ägare" => "owner"
	);
	
	$currentOption = GetHomeObjectRelevancy();
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<h3>
		Sortera efter
	</h3>

	<p class = "noSpaces">
		<select name = "homeObjectRelevancy">
			<?php foreach($options as $optionKey => $option): ?>
				<option value = "<?= $option; ?>" <?= ($currentOption == $option ? "selected" : "") ?>><?= $optionKey?></option>
			<?php endforeach; ?>
		</select>
	</p>
	
	<h3>
		Visa antal objekt
	</h3>
	
	<p>
		<input name = "homeObjectAmount" value = "<?= GetHomeObjectAmount(); ?>">
	</p>
	
	<p>
		<input name = "editHomeObjectRelevancy" class = "button" type = "submit" value = "Ändra">
	</p>	
</form>


<?php if(isset($successMessage) && !empty($successMessage)): ?>
<p>
	<?= $successMessage; ?>
</p>
<?php endif; ?>

<?php if(isset($errorMessage) && !empty($errorMessage)): ?>
<p class = "formErrors">
	<?= $errorMessage; ?>
</p>
<?php endif; ?>