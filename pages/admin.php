<h1>Administration</h1>

<div id = "adminSide">

<?php
	$usedCategories = array();
	$items = $adminPages;
	
	foreach($items as $itemKey => $item)
	{
		if(!in_array($item->mCategory, $usedCategories))
		{
			echo "
				<h2>" . $item->mCategory . "</h2>
				
				<ul>
			";
			
			array_push($usedCategories, $item->mCategory);
						
			foreach($items as $item2Key => $item2)
			{
				if($item->mCategory == $item2->mCategory)
				{
					echo "
						<li>
							<a href = \"?p=" . $currentPage. "&amp;subp=" . ($item2Key) . "\">" . ($item2->mTitle) . "</a>
						</li>
					";
				}
			}
			
			echo "</ul>";
		}
	}
?>
	
</div>

<div id = "adminContent">	
	<?php 
		if(isset($currentSubpage) && !empty($currentSubpage)) {
			$file = "pages/admin/" . $currentSubpage . ".php";
			$title = $adminPages[$currentSubpage]->mTitle;
		}
		else {
			reset($adminPages);
			
			$file = "pages/admin/" . key($adminPages) . ".php";
			$title = $adminPages[key($adminPages)]->mTitle;
		}
		
		if(file_exists($file)) {
		
			echo "<h2>" . $title . "</h2>";
			include($file);
		}
		else {
			include("pages/error.php");
		}
	?>
</div>

<div class = "clear"></div>