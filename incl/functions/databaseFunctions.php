<?php
	include("databaseRelationFunctions.php");
	include("databaseConfigurationFunctions.php");
	include("databaseArticleFunctions.php");
	include("databaseObjectFunctions.php");
	
	function RestoreDatabase()
	{
		global $dbPath;		
		global $dbPathBackup;
		copy($dbPathBackup, $dbPath);
	}
	
	function ConnectDB()
	{
		global $dbPath;
		
		$db = new PDO("sqlite:$dbPath");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				
		return $db;
	}

	function GetAbout()
	{
		$db = ConnectDB();
		
		$query = "SELECT content FROM Article WHERE category = ? LIMIT 1;";
		$stmt = $db->prepare($query);
		$stmt->execute(array("about"));
		
		return $stmt->fetch()[0];
	}
