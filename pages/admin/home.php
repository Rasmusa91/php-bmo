<?php
	if(isset($_POST["editHomeDescriptionSubmit"]))
	{
		$content = (isset($_POST["editHomePageDescriptionContent"]) ? $_POST["editHomePageDescriptionContent"] : "");
		SetHomePageDescription(strip_tags($content));
		$successMessage = "Du har ändrat beskrivningen på startsidan";
	}
?>

<form method = "post" action = "<?= GetURLExtension(); ?>">
	<p>
		<textarea name = "editHomePageDescriptionContent"><?= GetHomePageDescription(); ?></textarea>
	</p>

	<p>
		<input name = "editHomeDescriptionSubmit" class = "button" type = "submit" value = "Ändra">
	</p>
</form>

<?php if(isset($successMessage) && !empty($successMessage)): ?>
<p>
	<?= $successMessage; ?>
</p>
<?php endif; ?>