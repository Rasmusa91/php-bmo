<?php
	include("databaseFunctions.php");
	
	function GetURLExtension() {
		global $currentPage;
		global $currentSubpage;
				
		$output = "";
		
		if(isset($currentPage) && !empty($currentPage))
			$output .= "?p=" . $currentPage;
			
		if(isset($currentSubpage) && !empty($currentSubpage)) {
			if(empty($output))
				$output .= "?";
			else
				$output .= "&amp;";
				
			$output .= "subp=" . $currentSubpage;
		}
		
		return $output;
	}
	
	function GetImagePath($pPath, $pSubfolder = "")
	{
		return str_replace("bmo", "bmo/" . $pSubfolder, $pPath);
	}
	
	function GetPageTitle($pPage)
	{
		global $pages;
		
		return (isset($pages[$pPage]->mTitle) && !empty($pages[$pPage]->mTitle) ? $pages[$pPage]->mTitle : "Error" );
	}
	
	function GetSubpageTitle($pPage, $pSubpage)
	{
		$subPageTitle = "";
		
		if($pPage == "articles") {
			$article = GetArticle($pSubpage);
			
			if(!empty($article)) {
				$subPageTitle = $article["title"];
			}
			else {
				$subPageTitle = "Error";			
			}
		}
		else if($pPage == "gallery") {
			$object = getObject($pSubpage);
			
			if(!empty($object)) {
				$subPageTitle = $object["title"];
			}
			else {
				$subPageTitle = "Error";			
			}
		}
		else if ($pPage == "admin")
		{
			global $adminPages;
			
			if(isset($adminPages[$pSubpage])) {
				$subPageTitle = $adminPages[$pSubpage]->mTitle;
			}
			else {
				reset($adminPages);
				$subPageTitle = $adminPages[key($adminPages)]->mTitle;
			}
		}
		
		return $subPageTitle;
	}
	
	function ArrayContains2D($pValue, $pArray, $pKeyword) 
	{
		$arrayContains = false;
		
		for($i = 0; $i < count($pArray) && !$arrayContains; $i++)
		{
			if($pArray[$i][$pKeyword] == $pValue) {
				$arrayContains = true;
			}
		}
		
		return $arrayContains;
	}
	
	function Login($pUsername)
	{
		$_SESSION["loginLoggedIn"] = true;
		$_SESSION["loginUsername"] = ucfirst(strtolower($pUsername));
		
		global $wantLogin;
		global $wantPopup;
		$wantLogin = false;
		$wantPopup = false;
	}
	
	function Logout() {
		$_SESSION["loginLoggedIn"] = false;
		unset($_SESSION["loginUsername"]);
	}
	
	function IsLoggedIn() {
		return (isset($_SESSION["loginLoggedIn"]) && $_SESSION["loginLoggedIn"]);
	}
	
	function GetLoggedInUser() {
		return (isset($_SESSION["loginUsername"]) ? $_SESSION["loginUsername"] : "Unknown");
	}	

?>