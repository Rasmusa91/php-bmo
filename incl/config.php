<?php
	session_name(preg_replace('/[:\.\/-_]/', '', __FILE__));
	session_start();

	error_reporting(-1);
	
	include("functions/functions.php");
	include("common.php");
	//include("img/bmo/resize_images.php");
	include("classes.php");

	$pages = array(
		"home" => new Page("Home"),
		"articles" => new Page("Artiklar"),
		"gallery" => new Page("Galleri"),
		"about" => new Page("Om"),
		"search" => new Page("Sökning", "true"),
		"admin" => new Page("Admin", "login"),
		"source" => new Page("Källkod", "true")
	);
	
	$adminPages = array (
		"home" => new AdminPage("Editera startsidan", "Startsidan"),
		"homeObjectRelativity" => new AdminPage("Relevans för objekt", "Startsidan"),
		"homeArticleRelativity" => new AdminPage("Relevans för artiklar", "Startsidan"),
		
		"addArticle" => new AdminPage("Lägg till artikel", "Artiklar"),
		"editArticle" => new AdminPage("Redigera artikel", "Artiklar"),
		"removeArticle" => new AdminPage("Ta bort artikel", "Artiklar"),
		
		"addObject" => new AdminPage("Lägg till objekt", "Objekt"),
		"editObject" => new AdminPage("Redigera objekt", "Objekt"),
		"removeObject" => new AdminPage("Ta bort objekt", "Objekt"),
		
		"addRelation" => new AdminPage("Lägg till relationer", "Relationer"),
		"removeRelation" => new AdminPage("Ta bort relationer", "Relationer"),
		
		"restoreDatabase" => new AdminPage("Återställ databasen", "Återställning")
	);
	
	$accounts = array(
		array("username" => "Username", "password" => "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8") /*pw = password*/,
		array("username" => "Username2", "password" => "2aa60a8ff7fcd473d321e0146afd9e26df395147") /*pw = password2*/
	);
	
	$dbPath = "incl/data/bmo.sqlite";
	$dbPathBackup = "incl/data/bmoDefault.sqlite";
	
	$pageTimeGeneration = microtime(true);	
?>