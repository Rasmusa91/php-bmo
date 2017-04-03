<?php
	function GetConfigurationValue($pKey)
	{
		$db = ConnectDB();
		
		$query = "SELECT value FROM Configuration WHERE key = ? LIMIT 1;";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pKey));
		
		return $stmt->fetch()[0];
	}
	
	function SetConfigurationValue($pValue, $pKey)
	{
		$db = ConnectDB();
		
		$query = "	UPDATE Configuration
					SET value = ?
					WHERE key = ?;";
					
		$stmt = $db->prepare($query);
		$stmt->execute(array($pValue, $pKey));
	}
	
	function GetHomePageDescription()
	{
		return GetConfigurationValue("homePageDescription");
	}
	
	function SetHomePageDescription($pNewContent)
	{
		SetConfigurationValue($pNewContent, "homePageDescription");
	}	
	
	function GetHomeObjectRelevancy()
	{
		return GetConfigurationValue("homePageObjectRelevancy");
	}
	
	function SetHomeObjectRelevancy($pValue)
	{
		SetConfigurationValue($pValue, "homePageObjectRelevancy");
	}
	
	function GetHomeArticleRelevancy()
	{
		return GetConfigurationValue("homePageArticleRelevancy");
	}
	
	function SetHomeArticleRelevancy($pValue)
	{
		SetConfigurationValue($pValue, "homePageArticleRelevancy");
	}

	function GetHomeObjectAmount()
	{
		return GetConfigurationValue("homePageObjectAmount");
	}
	
	function SetHomeObjectAmount($pValue)
	{
		SetConfigurationValue($pValue, "homePageObjectAmount");
	}
	
	function GetHomeArticleAmount()
	{
		return GetConfigurationValue("homePageArticleAmount");
	}
	
	function SetHomeArticleAmount($pValue)
	{
		SetConfigurationValue($pValue, "homePageArticleAmount");
	}
?>