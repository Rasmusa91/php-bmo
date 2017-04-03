<?php		
	include("incl/config.php");
	
	$currentPage = (isset($_GET["p"]) ? $_GET["p"] : "home");
	$currentSubpage = (isset($_GET["subp"]) ? $_GET["subp"] : "");
	$wantLogin = (isset($_GET["login"]) && $_GET["login"] == "true");
	$wantPopup = $wantLogin;
		
	$title = "BMO " . (isset($pages[$currentPage]->mTitle) ? $pages[$currentPage]->mTitle : "");

	if($currentPage == "source")
	{
		$sourceNoEcho = true;
		$sourceBaseUrl = "?p=" . $currentPage . "&amp;";
		
		include("source.php");
	}

	include("incl/formValidator.php");
	include("incl/header.php");

	$file = "pages/" . $currentPage . ".php";
	if($currentPage != "source")
	{
		if((file_exists($file) && $currentPage != "admin") || ($currentPage == "admin" && IsLoggedIn())) {
			include($file);
		}
		else {
			include("pages/error.php");
		}
	}
	else if($currentPage == "source") {
		echo "$sourceBody";
	}
	
	include("incl/footer.php");	
?>