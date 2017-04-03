<?php
	class Page
	{
		public $mTitle;
		public $mHidden;
		
		function Page($pTitle, $pHidden = "")
		{
			$this->mTitle = $pTitle;
			$this->mHidden = $pHidden;
		}
	}
	
	class AdminPage
	{
		public $mTitle;
		public $mCategory;
		
		function AdminPage($pTitle, $pCategory = "")
		{
			$this->mTitle = $pTitle;
			$this->mCategory = $pCategory;
		}
	}
?>