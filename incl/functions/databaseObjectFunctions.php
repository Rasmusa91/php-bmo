<?php
	function AddObject($pTitle, $pOwner, $pCategory, $pImage, $pDescription)
	{
		$db = ConnectDB();
		
		$query = "	INSERT INTO Object
					(title, owner, category, image, text)
					VALUES(?, ?, ?, ?, ?);";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pTitle, $pOwner, $pCategory, $pImage, $pDescription));
	}
	
	function EditObject($objectID, $title, $owner, $category, $image, $description)
	{
		$db = ConnectDB();
		
		$query = "	UPDATE Object
					SET title = ?, owner = ?, category = ?, image = ?, text = ?
					WHERE id = ?;";
					
		$stmt = $db->prepare($query);
		$stmt->execute(array($title, $owner, $category, $image, $description, $objectID));
	}
	
	function RemoveObject($objectID)
	{
		$db = ConnectDB();
		
		$query = "	DELETE FROM Object
					WHERE id = ?;";
					
		$stmt = $db->prepare($query);
		$stmt->execute(array($objectID));	
	}

	function GetObjects($pStep = -1, $pPage = 1, $pCategory = "")
	{
		$db = ConnectDB();
				
		if(!empty($pCategory)) {
			$query = "SELECT * FROM Object WHERE category = ? LIMIT ?, ?;";
			$params = array($pCategory, ($pPage - 1) * $pStep, $pStep);
		}
		elseif($pStep != -1){
			$query = "SELECT * FROM Object LIMIT ?, ?;";		
			$params = array(($pPage - 1) * $pStep, $pStep);
		}
		else {
			$query = "SELECT * FROM Object;";		
			$params = array();
		}
		
		$stmt = $db->prepare($query);
		$stmt->execute($params);
		
		return $stmt->fetchAll();		
	}
	
	function GetAllObjectInCategory($pCategory)
	{
		$db = ConnectDB();
				
		$query = "SELECT * FROM Object WHERE category = ?;";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array($pCategory));
		
		return $stmt->fetchAll();		
	}	
	
	function GetObject($pID)
	{
		$db = ConnectDB();
		
		$query = "SELECT * FROM Object WHERE id = ?;";
		$stmt = $db->prepare($query);
		$stmt->execute(array($pID));
		
		return $stmt->fetch();	
	}
	
	function GetObjectCategories()
	{
		$db = ConnectDB();
		
		$query = "	SELECT category, COUNT(*) AS count 
					FROM Object
					GROUP BY category;";
					
		$stmt = $db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetchAll();		
	}
	
	function GetObjectAmount($pCategory = "")
	{
		$db = ConnectDB();
		
		if(empty($pCategory)) {
			$query = "	SELECT COUNT(*) AS count 
						FROM Object;";
		}
		else {
			$query = "	SELECT COUNT(*) AS count 
						FROM Object
						WHERE category = \"$pCategory\";";		
		}
		
		$stmt = $db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetch();	
	}
	
	function GetCloseObjects($pObjectID)
	{
		$startObjectID = $pObjectID - 2;
		
		if($startObjectID <= 0) {
			$startObjectID = 1;
		}
		
		if($startObjectID + 4 > GetObjectAmount()["count"]) {
			$startObjectID = GetObjectAmount()["count"] - 4;
		}
		
		$db = ConnectDB();
		
		$query = "	SELECT * 
					FROM Object 
					WHERE id != ?
					LIMIT ?, ?;";
		$params = array($pObjectID, $startObjectID - 1, 4);

		$stmt = $db->prepare($query);
		$stmt->execute($params);
		
		return $stmt->fetchAll();
	}

	function SearchObjects($searchQuery) 
	{
		$db = ConnectDB();
		
		$query = "
		SELECT * 
		FROM Object
		WHERE (category LIKE ?
		OR title LIKE ?);";
		
		$stmt = $db->prepare($query);
		$stmt->execute(array("%" . $searchQuery . "%", "%" . $searchQuery . "%"));
		
		return $stmt->fetchAll();
	}	
?>