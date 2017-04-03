<?php
	function GetRelatedObjects($pArticleID)
	{
		$db = ConnectDB();
		
		$query = "
		SELECT * 
		FROM ArticleObjectRelation
		INNER JOIN Object
		ON ArticleObjectRelation.o_id = Object.id
		WHERE a_id = ?;";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array($pArticleID));
		
		return $stmt->fetchAll();
	}
	
	function GetRelatedArticles($pObjectID)
	{
		$db = ConnectDB();
		
		$query = "
		SELECT * 
		FROM ArticleObjectRelation
		INNER JOIN Article
		ON ArticleObjectRelation.a_id = Article.id
		WHERE o_id = ?;";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array($pObjectID));
		
		return $stmt->fetchAll();
	}
	
	function GetRelatedObjectCategories($pArticleID)
	{
		$db = ConnectDB();
		
		$query = "
		SELECT DISTINCT Object.category 
		FROM ArticleObjectRelation
		INNER JOIN Object
		ON ArticleObjectRelation.o_id = Object.id
		WHERE a_id = ?;";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array($pArticleID));
		
		return $stmt->fetchAll();
	}
	
	function AddRelationsByCategory($pCurrentArticleID, $pCurrentObjectCategory)
	{
		$objects = GetAllObjectInCategory($pCurrentObjectCategory);
		
		foreach($objects as $object) {
			AddRelationSingle($pCurrentArticleID, intval($object["id"]));
		}
	}
	
	function AddRelationSingle($pCurrentArticleID, $pCurrentObjectID)
	{
		$db = ConnectDB();
		
		$query = "INSERT OR IGNORE INTO ArticleObjectRelation (a_id, o_id) VALUES (?, ?)";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pCurrentArticleID, $pCurrentObjectID));
	}
	
	function RemoveRelationSingle($pCurrentArticleID, $pCurrentObjectID)
	{
		$db = ConnectDB();
		
		$query = "DELETE FROM ArticleObjectRelation WHERE a_id = ? AND o_id = ?;";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pCurrentArticleID, $pCurrentObjectID));
	}
	
	function RemoveRelationsByCategory($pCurrentArticleID, $pCurrentObjectCategory)
	{
		$objects = GetAllObjectInCategory($pCurrentObjectCategory);
		
		foreach($objects as $object) {
			RemoveRelationSingle($pCurrentArticleID, intval($object["id"]));
		}
	}
	
	function RemoveRelationsAll($pCurrentArticleID)
	{
		$objects = GetRelatedObjects($pCurrentArticleID);
		
		foreach($objects as $object) {
			RemoveRelationSingle($pCurrentArticleID, intval($object["id"]));
		}		
	}
	
	function GetArticlesWithRelations()
	{
		$db = ConnectDB();
		
		$query = "
		SELECT DISTINCT Article.id, Article.title 
		FROM ArticleObjectRelation
		INNER JOIN Article
		ON ArticleObjectRelation.a_id = Article.id;";
		
		$stmt = $db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
?>