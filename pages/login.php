<h1>Logga in</h1>

<div id = "login">
	<form method="post" action="<?= GetURLExtension(); ?>&login=true">
		<p>
			<p class = "noSpaces">
				Användarnamn: <br>
			</p>
			<p class = "noSpaces">
				<input name = "loginUsername" value = "<?= (isset($_POST["loginUsername"]) ? $_POST["loginUsername"] : "" ); ?>">
			</p>
		</p>
		
		<p>
			<p class = "noSpaces">
				Lösenord:
			</p>
			<p class = "noSpaces">
				<input name = "loginPassword" type = "password">
			</p>
		</p>
		
		<p class = "noSpaces">
			<input id = "loginButton" class = "button right" type = "submit" name = "loginSubmit" value = "Logga in">
		</p>
		
		<div class = "clear"></div>
		
		<?php if(isset($errorString) && !empty($errorString)): ?>
			<div class = "formErrors">
				<?= $errorString ?>
			</div>
		<?php endif; ?>
	</form>
</div>