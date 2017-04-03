<?php		
	function AddArticle($pTitle, $pAuthor, $pCategory, $pContent)
	{
		$db = ConnectDB();
		
		$query = "	INSERT INTO Article
					(title, author, category, content)
					VALUES(?, ?, ?, ?);";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pTitle, $pAuthor, $pCategory, $pContent));
	}
	
	function EditArticle($pArticleID, $pTitle, $pAuthor, $pCategory, $pContent)
	{
		$db = ConnectDB();
		
		$query = "	UPDATE Article
					SET title = ?, author = ?, category = ?, content = ?
					WHERE id = ?;";
					
		$stmt = $db->prepare($query);
		$stmt->execute(array($pTitle, $pAuthor, $pCategory, $pContent, $pArticleID));
	}
	
	function RemoveArticle($pArticleID)
	{
		$db = ConnectDB();
		
		$query = "	DELETE FROM Article
					WHERE id = ?;";
					
		$stmt = $db->prepare($query);
		$stmt->execute(array($pArticleID));
	}

	function GetArticles($pLimit = -1, $pOrderBy = "id")
	{
		$db = ConnectDB();
		
		$params = array("about");
		
		if($pLimit == -1) {
			$query = "SELECT * FROM Article WHERE category != ? ORDER BY ?;";
			array_push($params, $pOrderBy);
		}
		else {
			$query = "SELECT * FROM Article WHERE category != ? ORDER BY ? LIMIT ?;";
			array_push($params, $pOrderBy);
			array_push($params, $pLimit);
			
		}
		
		$stmt = $db->prepare($query);
		$stmt->execute($params);
		
		return $stmt->fetchAll();
	}	
	
	function GetArticle($pArticleID)
	{
		$db = ConnectDB();
		
		$query = "SELECT * FROM Article WHERE id = ? LIMIT 1;";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pArticleID));

		return $stmt->fetch();
	}
	
	function GetNextArticle($pArticleID, $pIncrement = 1) 
	{
		$pArticleID += $pIncrement;
		
		$article = GetArticle($pArticleID);

		if($article["category"] == "about") {
			$article = GetNextArticle($pArticleID, $pIncrement);
		}
		
		return $article;
	}

	function SearchArticles($searchQuery)
	{
		$db = ConnectDB();
		
		$query = "
		SELECT * 
		FROM Article
		WHERE (content LIKE ?
		OR title LIKE ?)
		AND category != \"about\";";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array("%" . $searchQuery . "%", "%" . $searchQuery . "%"));
		
		return $stmt->fetchAll();
	}
?>