<?php
	$errorString = "";
	$successString = "";

	if(isset($_POST["loginSubmit"]) && !IsLoggedIn())
	{
		$username = (isset($_POST["loginUsername"]) ? $_POST["loginUsername"] : "");
		$password = (isset($_POST["loginPassword"]) ? $_POST["loginPassword"] : "");
	
		if(empty($username)) {
			$errorString .= "<p>* Ange ditt användarnamn!</p>";
		}
		
		if(empty($password)) {
			$errorString .= "<p>* Ange ditt lösenord!</p>";
		}
		
		if(empty($errorString))
		{
			$match = false;
			
			foreach($accounts as $account)
			{
				if(strtolower($account["username"]) == strtolower($username) && $account["password"] == sha1($password)) {
					$match = true;
				}
			}
			
			if($match) {
				Login($username);
			}
			else {
				$errorString .= "<p>* Inget användarnamn matchade med det lösenordet!</p>";
			}
		}
	}
	
	if(isset($_GET["logout"]) && $_GET["logout"] == "true" && IsLoggedIn()) {
		Logout();
	}
?>