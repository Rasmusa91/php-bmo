<!doctype html>
<html lang = "sv">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		
		<link rel="stylesheet" href="style/stylesheet.css">
		<link rel="shortcut icon" href="img/favicon.png">
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
		<?php
			if(isset($sourceStyle))
			{
				echo "
				<style type = \"text/css\">
					" . $sourceStyle . "
				</style>
				";
			}
		?>	
	</head>
	
	<body>
		<div id = "wrapper">
			<div id = "header">
				<div id = "headerRight">
					<?php if(IsLoggedIn()): ?>
						<a href = "?p=admin"><?= GetLoggedInUser(); ?></a> - <a href = "<?= ($currentPage != "admin" ? GetURLExtension() : "?p=home"); ?>&logout=true">Logga ut</a>
					<?php else: ?>
						<a href = "<?= GetURLExtension(); ?>&login=true">Logga in</a>
					<?php endif; ?>
				</div>	
				
				<div id = "headerLogo">
					<span id = "headerLogoBigLeft">BM</span>O
				</div>
				
				<p id = "headerLogoSmall">Begravningsmuseum Online</p>
			</div>
			<div id = "navBar">
				<div id = "navBarMenu" class = "left">
					<?php 
					foreach($pages as $pageKey => $page): 
						if(empty($page->mHidden) || ($page->mHidden == "login" && IsLoggedIn())):
					?>
							<a <?= ($pageKey == $currentPage ? "class = \"navBarCurrent\"" : "") ?> href = "?p=<?= $pageKey; ?>"><?= $page->mTitle; ?></a>
					<?php 
						endif;
					endforeach; 
					?>
				</div>
				<div class = "right">
					<div id = "search">
						<form name = "searchForm" method = "post" action = "?p=search">	
							
							<div id = "searchLeft">
								<input name = "searchQuery" value = "<?= (isset($_POST["searchQuery"]) ? $_POST["searchQuery"] : ""); ?>">
							</div>
							<div id = "searchRight">
								<a href="#" OnClick="searchForm.submit();"><img src = "style/img/searchButton.jpg"></a>
							</div>
							<div class = "clear"></div>
						</form>
					</div>
				</div>
				<div class = "clear"></div>
			</div>
			<div id = "siteMap">
				<a href = "?p=<?= $currentPage; ?>" <?= (empty($currentSubpage) ? "class = \"selectedLink\"" : ""); ?>><?= GetPageTitle($currentPage); ?></a> 
				<?php if (!empty($currentSubpage)):?>
					/ <a href = "?p=<?= $currentPage; ?>&subp=<?= $currentSubpage; ?>" class = "selectedLink"><?= GetSubpageTitle($currentPage, $currentSubpage); ?></a>
				<?php endif; ?>
			</div>
			<div id = "content">