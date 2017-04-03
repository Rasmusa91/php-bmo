<?php
	if(isset($_POST["editHomeArticleRelevancy"]))
	{
		$relevancy = (isset($_POST["homeArticleRelevancy"]) ? $_POST["homeArticleRelevancy"] : "");
		$amount = (isset($_POST["homeArticleAmount"]) ? $_POST["homeArticleAmount"] : "");

		if(is_numeric($amount) && $amount > 0) {
			SetHomeArticleAmount($amount);
			SetHomeArticleRelevancy($relevancy);
			$successMessage = "Du har ändrat relevans för artiklar på startsidan";
		}
		else {
			$errorMessage = "* Antalet måste innehålla ett heltal större eller lika med 0";
		}
	}
	
	$options = array(
		"ID" => "id",
		"Kategori" => "category",
		"Titel" => "title",
		"Innehåll" => "text",
		"Författare" => "author",
		"Datum" => "pubdate"
	);
	
	$currentOption = GetHomeArticleRelevancy();
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<h3>
		Sortera efter
	</h3>

	<p class = "noSpaces">
		<select name = "homeArticleRelevancy">
			<?php foreach($options as $optionKey => $option): ?>
				<option value = "<?= $option; ?>" <?= ($currentOption == $option ? "selected" : "") ?>><?= $optionKey?></option>
			<?php endforeach; ?>
		</select>
	</p>
	
	<h3>
		Visa antal artiklar
	</h3>
	
	<p>
		<input name = "homeArticleAmount" value = "<?= GetHomeArticleAmount(); ?>">
	</p>	
	
	<p>
		<input name = "editHomeArticleRelevancy" class = "button" type = "submit" value = "Ändra">
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