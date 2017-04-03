
<?php
	if(isset($_POST["restore"]))
	{
		RestoreDatabase();
		$successMessage = "Du har återställt databasen!";
	}	
?>

<p>
	<h3>Är du säker på att du vill återställa databasen?</h3>
	
	<form method = "post" action = "<?= GetURLExtension(); ?>">
		<input type = "submit" class = "button" value = "Återställ" name = "restore">
	</form>
</p>

<?php if(isset($successMessage) && !empty($successMessage)): ?>
<p>
	<?= $successMessage; ?>
</p>
<?php endif; ?>