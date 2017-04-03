<?php
	$cat = (isset($_GET["cat"]) ? $_GET["cat"] : "Alla");
	$step = (isset($_GET["step"]) ? $_GET["step"] : 10);
	$page = (isset($_GET["page"]) ? $_GET["page"] : 1);
	
	$categories = GetObjectCategories();	

	if(!ArrayContains2D($cat, $categories, "category")) {
		$cat = "Alla";
	}

	$availableSteps = array(5, 10, 15, 20);

	if(!in_array($step, $availableSteps)) {
		$step = 10;
	}
	
	$availablePagesAmount = ceil(GetObjectAmount($cat == "Alla" ? "" : $cat)["count"] / $step);
	
	if($page < 1 || $page > $availablePagesAmount) {
		$page = 1;
	}	
	
	$objects = GetObjects(intval($step), intval($page), $cat == "Alla" ? "" : $cat);
	
?>

<div id = "galleryHeader">
	<div id = "galleryTitle" class = "left">
		<h1>Galleri</h1>
		<h2><?= $cat; ?></h2>
	</div>

	<div id = "galleryDropdown" class = "right">
		<p>Välj kategori</p>
			
		<form method="get">
			<input name = "p" value = "<?= $currentPage; ?>" hidden>
			<input name = "step" value = "<?= $step; ?>" hidden>

			<select name = "cat" OnChange = "submit()">
				<option value = "Alla">Alla (<?= GetObjectAmount()["count"]; ?>)</option>
				<?php foreach($categories as $category): ?>
					<option value = "<?= $category["category"];?>" <?= ($cat == $category["category"] ? "selected" : "") ?>><?= $category["category"]; ?> (<?= $category["count"]; ?>)</option>
				<?php endforeach; ?>
			</select>
		</form>
	</div>

	<div id = "galleryDropdownStep" class = "right">
		<p>Visa antal</p>
			
		<form method="get">
			<input name = "p" value = "<?= $currentPage; ?>" hidden>
			<input name = "cat" value = "<?= $cat; ?>" hidden>
			
			<select id = "galleryStepDropdown" name = "step" OnChange = "submit()">
				<?php foreach($availableSteps as $availableStep): ?>
					<option value = "<?= $availableStep; ?>" <?= ($step == $availableStep ? "selected" : "") ?>><?= $availableStep; ?></option>
				<?php endforeach; ?>
			</select>
		</form>
	</div>
</div>

<div class = "clear"></div>

<?php for($i = 0; $i < count($objects); $i++): ?>
	<div class = "galleryPreviewWrapper <?= (($i + 1) % 4 == 0 ? "galleryPreviewNoMargin" : ""); ?>">
		<div class = "galleryPreview">
			<a href = "?p=gallery&subp=<?= $objects[$i]["id"]; ?>"><img src = "<?= GetImagePath($objects[$i]["image"], 150); ?>"></a>
		</div>
	</div>	
<?php endfor; ?>

<div class = "clear"></div>

<div id = "galleryNavigation">
	<?php for($i = 1; $i <= $availablePagesAmount; $i++): ?>
		<a <?= ($i == $page ? "class = \"selectedLink\"" : "") ?> href = "?p=<?= $currentPage; ?>&step=<?= $step; ?>&cat=<?= $cat; ?>&page=<?= $i; ?>"><?= $i; ?></a> 
	<?php endfor; ?>
</div>