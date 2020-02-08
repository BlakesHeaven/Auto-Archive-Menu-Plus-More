<?php

class pluginAutoArchiveMenuPlusMore extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
			'durationType'=>'month',
			'alwaysShowUpcomingSectionLabel'=>false,
			'upcomingFillinText'=>'',

			'displayStaticPagesSection'=>true,
			'staticLabel'=>'Static Pages',
			'homeLink'=>true,
			
			'displayUpcomingSection'=>true,
			'upcomingLabel'=>'Upcoming Section',
			'showUpcomingChildren'=>true,

			'currentLabel'=>'Current Section',
			'currentAfter'=>1,
			'showCurrentChildren'=>true,

			'displayArchiveSection'=>true,
			'archiveLabel'=>'Archive Section',
			'archiveAfter'=>4,
			'numberOfItems'=>5,
			'showArchiveChildren'=>true,

			'hiddenCategory'=>'Hidden',

			'displayAdminStuffSection'=>true,
			'adminCategory'=>'Admin Stuff',
			'adminStuffLabel'=>'Admin Stuff',
			'showAdminStuffChildren'=>true
		);
	}

	public function beforeSiteLoad()
	{
		$login = new Login();

		if ( $login->isLogged()) {
			$username = $login->username();
			$user = new User($username);

			$GLOBALS['userRole'] = $login->Role();
			$GLOBALS['userDisplayName'] =  $user->nickname() ?: $user->firstname() ?: $username; 
		}
		else {
			$GLOBALS['userRole'] = 'No Role';
			$GLOBALS['userDisplayName'] = 'No Name';
		}
	}

	public function adminHead()
	{
		// Include plugin's CSS files
		$html = $this->includeCSS('style.css');

		return $html;
	}
	
	// Method called on the settings of the plugin on the admin area
	public function form()
	{
	
		global $L;
		$items = getCategories();
		$currentAdminCategory = $this->getValue('adminCategory');
		$currentHiddenCategory = $this->getValue('hiddenCategory');

		$html  = '';
		$html .= '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
		$html .= '</div>';
		
		$html .= '<div class="AutoArchiveMenuPlusMore-plugin">';
		/********************************************************
			Global Options
		********************************************************/
		$html .= '<h3>'.$L->get('global-options-title').'</h3> ';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Define the duration type
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('duration-type-label').'</label>';
				$html .= '<select name="durationType">';
				$html .= '<option value="week" '.($this->getValue('durationType')==='week'?'selected':'').'>'.$L->get('week').'</option>';
				$html .= '<option value="month" '.($this->getValue('durationType')==='month'?'selected':'').'>'.$L->get('month').'</option>';
				$html .= '<option value="year" '.($this->getValue('durationType')==='year'?'selected':'').'>'.$L->get('year').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('duration-type-tip').'</span>';
			$html .= '</div>';
			// Hide pages from menu for a particular category
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('hidden-category').'</label>';
				$html .= '<select name="hiddenCategory">';
					foreach ($items as $category) {
						$categoryName = $category->name();
						IF ($categoryName != $currentAdminCategory) {
							$html .= '<option value="'.$categoryName.'" '.($currentHiddenCategory===$categoryName?'selected':'').'>'.$categoryName.'</option>';
						}
					}
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('hidden-category-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<hr>';
		/********************************************************
			Options for STATIC Pages section
		********************************************************/		
		$html .= '<h3>'.$L->get('static-pages-options-title').'</h3> ';
		
		// Menu Label for Static Pages Section
		$html .= '<div>';
			$html .= '<label class="labelStyle">'.$L->get('Static Label').'</label>';
			$html .= '<input id="jsstaticLabel" name="staticLabel" type="text" value="'.$this->getValue('staticLabel').'">';
			$html .= '<span class="tip">'.$L->get('static-label-tip').'</span>';
		$html .= '</div>';
		
		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Enable/Disable STATIC Pages section
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('display-static-pages-section').'</label>';
				$html .= '<select name="displayStaticPagesSection">';
				$html .= '<option value="true" '.($this->getValue('displayStaticPagesSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('displayStaticPagesSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('display-static-pages-section-tip').'</span>';
			$html .= '</div>';
			// Display 'Home Page' in Static Pages section
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('home-link').'</label>';
				$html .= '<select name="homeLink">';
				$html .= '<option value="true" '.($this->getValue('homeLink')?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.(!$this->getValue('homeLink')?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('home-link-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<hr>';
		/********************************************************
			Options for UPCOMING section
		********************************************************/
		$html .= '<h3>'.$L->get('upcoming-section-title').'</h3>';
		// Menu Label for UPCOMING Section
		$html .= '<div>';
			$html .= '<label class="labelStyle">'.$L->get('upcoming-label').'</label>';
			$html .= '<input id="jsupcominglabel" name="upcomingLabel" type="text" value="'.$this->getValue('upcomingLabel').'">';
			$html .= '<span class="tip">'.$L->get('upcoming-label-tip').'</span>';
		$html .= '</div>';
		

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Enabled/Disabled
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('display-upcoming-section').'</label>';
				$html .= '<select name="displayUpcomingSection">';
				$html .= '<option value="true" '.($this->getValue('displayUpcomingSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('displayUpcomingSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('display-upcoming-section-tip').'</span>';
			$html .= '</div>';
			// Show UPCOMING CHILDREN or not
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('show-upcoming-children').'</label>';
				$html .= '<select name="showUpcomingChildren">';
				$html .= '<option value="true" '.($this->getValue('showUpcomingChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('showUpcomingChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('show-upcoming-children-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// What to do about nothing in UPCOMING section - i.e. when no content is due to appear
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('upcoming-nothing-label').'</label>';
				$html .= '<select name="alwaysShowUpcomingSectionLabel">';
				$html .= '<option value="true" '.($this->getValue('alwaysShowUpcomingSectionLabel')===true?'selected':'').'>'.$L->get('show-upcoming-section-label').'</option>';
				$html .= '<option value="false" '.($this->getValue('alwaysShowUpcomingSectionLabel')===false?'selected':'').'>'.$L->get('hide-upcoming-section-label').'</option>';
				$html .= '</select>';
			$html .= '<span class="tip">'.$L->get('upcoming-nothing-tip').'</span>';
			$html .= '</div>';
			// IF Section Label is shown and there is no content, display some fill-in text instead.
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('fillin-text-label').'</label>';
				$html .= '<input id="jsupcomingFillinText" name="upcomingFillinText" type="text" value="'.$this->getValue('upcomingFillinText').'">';
				$html .= '<span class="tip">'.$L->get('fillin-text-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';
		
		$html .= '<hr>';		
		/********************************************************
			Options for CURRENT section
		********************************************************/
		// Menu Label for CURRENT section
		$html .= '<h3>'.$L->get('current-section-title').'</h3>';
		$html .= '<div>';
			$html .= '<label class="labelStyle">'.$L->get('current-label').'</label>';
			$html .= '<input id="jscurrentlabel" name="currentLabel" type="text" value="'.$this->getValue('currentLabel').'">';
			$html .= '<span class="tip">'.$L->get('current-label-tip').'</span>';
		$html .= '</div>';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Current after X time, e.g. weeks
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('current-after').'</label>';
				$html .= '<input id="jscurentafter" name="currentAfter" type="number" value="'.$this->getValue('currentAfter').'">';
				$html .= '<span class="tip">'.$L->get('current-after-tip').'</span>';
			$html .= '</div>';
			// Show CURRENT CHILDREN or not
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('show-current-children').'</label>';
				$html .= '<select name="showCurrentChildren">';
				$html .= '<option value="true" '.($this->getValue('showCurrentChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('showCurrentChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('show-current-children-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';
		
		$html .= '<hr>';
		/********************************************************
			Options for ARCHIEVE section
		********************************************************/
		// Section label
		$html .= '<h3>'.$L->get('archive-section-title').'</h3>';

		// Menu Label for Archive section
		$html .= '<div>';
			$html .= '<label class="labelStyle">'.$L->get('archive-label').'</label>';
			$html .= '<input id="jsarchivelabel" name="archiveLabel" type="text" value="'.$this->getValue('archiveLabel').'">';
			$html .= '<span class="tip">'.$L->get('archive-label-tip').'</span>';
		$html .= '</div>';
		
		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Enable/Disable Archive section
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('display-archive-section').'</label>';
				$html .= '<select name="displayArchiveSection">';
				$html .= '<option value="true" '.($this->getValue('displayArchiveSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('displayArchiveSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('display-archive-section-tip').'</span>';
			$html .= '</div>';
			// Show ARCHIEVE CHILDREN or not
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('show-archive-children').'</label>';
				$html .= '<select name="showArchiveChildren">';
				$html .= '<option value="true" '.($this->getValue('showArchiveChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('showArchiveChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('show-archive-children-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Archive after X time, e.g. weeks
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('archive-after').'</label>';
				$html .= '<input id="jsarchiveAfter" name="archiveAfter" type="number" value="'.$this->getValue('archiveAfter').'">';
				$html .= '<span class="tip">'.$L->get('archive-after-tip').'</span>';
			$html .= '</div>';
			// Display X number of Archived items
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('number-of-items-label').'</label>';
				$html .= '<input id="jsnumberOfItems" name="numberOfItems" type="number" value="'.$this->getValue('numberOfItems').'">';
				$html .= '<span class="tip">'.$L->get('number-of-items-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<hr>';
		/********************************************************
			More options for other functionality
		********************************************************/
		// Section label HEADER
		$html .= '<h3>'.$L->get('plus-some-section-title').'</h3>';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Enable/Disable Admin Stuff section
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('display-admin-stuff-section').'</label>';
				$html .= '<select name="displayAdminStuffSection">';
				$html .= '<option value="true" '.($this->getValue('displayAdminStuffSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('displayAdminStuffSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('display-admin-stuff-section-tip').'</span>';
			$html .= '</div>';
			// Show Admin Stuff CHILDREN or not
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('show-admin-stuff-children').'</label>';
				$html .= '<select name="showAdminStuffChildren">';
				$html .= '<option value="true" '.($this->getValue('showAdminStuffChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
				$html .= '<option value="false" '.($this->getValue('showAdminStuffChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('show-admin-stuff-children-tip').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';

		$html .= '<div class="divTable" style="width: 100%;" ><div class="divTableBody"><div class="divTableRow">';
			// Menu Label for ADMIN STUFF Section
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('admin-stuff-label').'</label>';
				$html .= '<input id="jsadminStufflabel" name="adminStuffLabel" type="text" value="'.$this->getValue('adminStuffLabel').'">';
				$html .= '<span class="tip">'.$L->get('admin-stuff-label-tip').'</span>';
			$html .= '</div>';	
			// Set a particular category to be for Admin Stuff
			$html .= '<div class="divTableCell">';
				$html .= '<label class="labelStyle">'.$L->get('admin-stuff-category').'</label>';
				$html .= '<select name="adminCategory">';
					foreach ($items as $category) {
						$categoryName = $category->name();
						IF ($categoryName != $currentHiddenCategory) {
							$html .= '<option value="'.$categoryName.'" '.($currentAdminCategory===$categoryName?'selected':'').'>'.$categoryName.'</option>';
						}
					}
				$html .= '</select>';
				$html .= '<span class="tip">'.$L->get('admin-stuff-category-tip1').'</span>';
				$html .= '<span class="tip">'.$L->get('admin-stuff-category-tip2').'</span>';
			$html .= '</div>';
		$html .= '</div></div></div>';
		$html .= '<hr>';		
		$html .= '</div>';// Close class="AutoArchiveMenuPlusMore-plugin"
		return $html;
	}

	// Method called on the sidebar of the website
	public function siteSidebar()
	{
		global $L;
		global $site;
		global $pages;
		global $parents;
		global $userRole;

		/*******************************************************************************
		Let's fill some variables...
		*******************************************************************************/

		$parentSortDesc = true;
		$childrenSortDesc = true;

		// Do we show Admin section and is user allowed to see it?
		$displayAdminStuffSection = $this->getValue('displayAdminStuffSection');
		$adminCategory = $this->getValue('adminCategory');

		IF (($displayAdminStuffSection) && in_array($userRole, array("editor","admin")) ) {
			global $userDisplayName;

			// Admin Stuff Menu Label
			$adminStuffLabel = $this->getValue('adminStuffLabel');
			// Do we show Admin Stuff Children?
			$showAdminStuffChildren = $this->getValue('showAdminStuffChildren');			
		}
		// Do we display Upcoming section?
		$displayUpcomingSection = $this->getValue('displayUpcomingSection');
		IF ($displayUpcomingSection) {
			$upcomingLabel = $this->getValue('upcomingLabel');			
			// Do we show Upcoming Children?
			$showUpcomingChildren = $this->getValue('showUpcomingChildren');
			$upcomingFillinText = $this->getValue('upcomingFillinText');
		}
		// We always show current section so just get info...
		$currentLabel = $this->getValue('currentLabel');
		$durationType = $this->getValue('durationType');		// Day, Week, Month.
		// How much time passes from the published date before being current - should be less than archive values below.
		IF ($displayUpcomingSection) {$currentAfter = $this->getValue('currentAfter');}
		ELSE {$currentAfter = 0;}
		$currentEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$currentAfter $durationType");
		// Do we show Current Children?
		$showCurrentChildren = $this->getValue('showCurrentChildren');
		// Do we show Archive section?
		$displayArchiveSection = $this->getValue('displayArchiveSection');
		IF ($displayArchiveSection) {
			// Get archive Label/
			$archiveLabel = $this->getValue('archiveLabel');	
			// How much time passes from the published date before archiving - should be greater than current values above.
			$archiveAfter = $this->getValue('archiveAfter');
			$archiveEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$archiveAfter $durationType");
			// Number of Archive Parent pages to show and a counter/
			$numberOfItems = $this->getValue('numberOfItems');
			$countOfItems = 0;
			// Do we show Archive Children?
			$showArchiveChildren = $this->getValue('showArchiveChildren');		
		}
		// Hidden Category
		$hiddenCategory = $this->getValue('hiddenCategory');
		// Display Static Pages Section
		$displayStaticPagesSection = $this->getValue('displayStaticPagesSection');
		// Static Page Label
		$staticLabel = $this->getValue('staticLabel');
		// Page number the first one
		$pageNumber = 1;
		// Misc - Other variables
		$onlyPublished = true; 
		$showSectionLabelIfEmpty = $this->getValue('alwaysShowUpcomingSectionLabel');
		// Get the list of pages
		IF (ORDER_BY=='position') 
		{	$parents = buildParentPages();}
		ELSE
		{	$publishedPagesByDate = $pages->getList($pageNumber, -1, $onlyPublished);} // -1 gets all pages
		

		// DESC OR ASC
		IF ($parentSortDesc) {
			// DESC
			uasort($parents, function($a, $b) { return strtotime($b->dateRaw()) - strtotime($a->dateRaw()); });
		}
		ELSE {
			// ASC
			uasort($parents, function($a, $b) { return strtotime($a->dateRaw()) - strtotime($b->dateRaw()); });
		}
                    			
		// Declare EXIST variables for each section to FALSE, upcoming, current & archive.
		$adminPagesExist = false;
		$upcomingPagesExist = false;
		$currentPagesExist = false;
		$archivePagesExist = false;
		// For each page, check IF applicable for ADMIN STUFF section, set variable to TRUE and break out of loop
		IF (($displayAdminStuffSection) && in_array($userRole, array("editor","admin") ) ) {
			FOREACH($parents as $parent) {
				IF ($parent->category() === $adminCategory) {
					$adminPagesExist = true;
					break;
				}
			}			
		}
		/***************************************************************************************
		DETERMINE IF PAGES EXIST FOR EACH SECTION - ORDERED EITHER BY POSITION OR PUBLISED DATE
		****************************************************************************************/
		IF (ORDER_BY=='position') 
		{	// For each page, check IF applicable for UPCOMING section, set variable to TRUE and break out of loop
					
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory) ) 
					&& strtotime( $parent->date() ) > $currentEpoch) 
				{
					$upcomingPagesExist = true;
					break;
				}
			}
			// For each page, check IF applicable for CURRENT section, set variable to TRUE and break out of loop
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory) ) 
					&& strtotime( $parent->date() ) > $archiveEpoch 
						&& strtotime( $parent->date() ) <= $currentEpoch ) 
				{
					$currentPagesExist = true;
					break;
				}
			}
			// For each page, check IF applicable for ARCHIVE section, set variable to TRUE and break out of loop
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory) ) 
					&& strtotime( $parent->date() ) <= $archiveEpoch ) 
				{
					$archivePagesExist = true;
					break;
				}
			}
		}
		else 
		{	// For each page, check IF applicable for UPCOMING section, set variable to TRUE and break out of loop		
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory) ) 
							&& strtotime( $page->date() ) > $currentEpoch) 
						{
							$upcomingPagesExist = true;
							break;
						}
				}
				catch (Exception $e) { }// continue...
			}
			// For each page, check IF applicable for CURRENT section, set variable to TRUE and break out of loop
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory) ) 
							&&	strtotime( $page->date() ) > $archiveEpoch 
								&& strtotime( $page->date() ) <= $currentEpoch ) 
						{
							$currentPagesExist = true;
							break;
						}
				}
				catch (Exception $e) { } // continue...
			}
			// For each page, check IF applicable for ARCHIVE section, set variable to TRUE and break out of loop
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory) ) 
							&& strtotime( $page->date() ) <= $archiveEpoch ) 
						{
							$archivePagesExist = true;
							break;
						}
				}
				catch (Exception $e) { } // continue...
			}
		}

		// Build HTML for the sidebar.
		$html  = '';
		
		/******************************************************************************
		SECTION FOR SHOWING STATIC PAGES UNLESS ADMIN OR HIDDEN. ORDERED BY POSITION ONLY
		*******************************************************************************/
		IF ($displayStaticPagesSection) 
		{
			$staticPages = buildStaticPages();

			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($staticLabel)) {				
				$html .= '	<h2 class="plugin-label">'.$staticLabel.'</h2>';
			}

			$html .= '<div class="plugin-content">';
			$html .= '<ul>';

			// Show Home page link
			IF ($this->getValue('homeLink')) {
				$html .= '<li>';
				$html .= '	<a href="' . $site->url() . '">' . $L->get('Home page') . '</a>';
				$html .= '</li>';
			}

			FOREACH ($staticPages as $page) {
				IF ( !in_array($page->category(), array($hiddenCategory,$adminCategory) ) ) {
					$html .= '<li>';
					$html .= '	<a href="' . $page->permalink() . '">' . $page->title() . '</a>';
					$html .= '</li>';
				}
			}
			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}

		/*******************************************************************************
		SECTION FOR PAGES PUBILSHED WITH CATEGORY FOR THE ADMIN BY POSITION ONLY
		*******************************************************************************/
		IF ( ($adminPagesExist) 
				&& ($displayAdminStuffSection) 
				&& in_array($userRole, array("editor","admin") ) )
		{
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($adminStuffLabel)) {
				$html .= '	<h2 class="plugin-label">' . $adminStuffLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (!$userDisplayName == "") {
				$html .= $L->get('welcome').' '.$userDisplayName;
			}

			FOREACH ($parents as $parent) {

				IF ( $parent->category() == $adminCategory ) {

					$html .= '<li class="parent">';
					$html .= '	<h3>';
					$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
					$html .= '	</h3>';

					IF ( $parent->hasChildren() && $showAdminStuffChildren ) {

						$children = $parent->children();
						$html .= '<ul class="child">';

						FOREACH ($children as $child) {

							IF ( $child->category() == $adminCategory )  {

								$html .= '<li class="child">';
								$html .= '	<a class="child" href="' . $child->permalink() . '">' . $child->title() . '</a>';
								$html .= '</li>';
							}
						}

						$html .= '</ul>';
					}

					$html .= '</li>';
				}
			}
			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}
		
		/*******************************************************************************
		SECTION FOR SHOWING UPCOMING TOPICS - PUBILSHED, BUT NOT YET CURRENT
		*******************************************************************************/
		IF ( $displayUpcomingSection 
				&& $upcomingPagesExist OR ($showSectionLabelIfEmpty 
											&& !empty($upcomingFillinText) )
			)
		{
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($upcomingLabel)  ) {

				$html .= '	<h2 class="plugin-label">' . $upcomingLabel . '</h2>';
				
				IF (!$upcomingPagesExist
						&& $showSectionLabelIfEmpty
						&& !empty($upcomingFillinText)
					) 
				{
					$html .= $upcomingFillinText;
				}
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (ORDER_BY=='position') {

				FOREACH($parents as $parent) {

					IF ( strtotime( $parent->date() ) > $currentEpoch 
							&& !in_array($parent->category(), array($hiddenCategory,$adminCategory) ) ) {

						$html .= '<li class="parent">';
						$html .= '	<h3>';
						$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
						$html .= '	</h3>';

						IF ( $parent->hasChildren() && $showUpcomingChildren ) {

							$children = $parent->children();
							$html .= '<ul class="child">';

							FOREACH ($children as $child) {

								IF ( strtotime( $child->date() ) > $currentEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) )  {

									$html .= '<li class="child">';
									$html .= '	<a class="child" href="' . $child->permalink() . '">' . $child->title() . '</a>';
									$html .= '</li>';
								}
							}
							$html .= '</ul>';
						}
						$html .= '</li>';
					}
				}
			}
			else {	// Page order by date

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
						$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) > $currentEpoch
								&& !in_array($page->category(), array($hiddenCategory,$adminCategory) )
								&& !$page->isChild() ) 
						{							
							$html .= '<li class="parent">';
							$html .= '	<h3>';						
							$html .= '		<a class="parent" href="' . $page->permalink() . '">' . $page->title() . '</a>';
							$html .= '	</h3>';

							$children = $page->children();

							IF ( $page->hasChildren() && $showUpcomingChildren ) {

								$children = $page->children();
								$html .= '<ul class="child">';

								FOREACH ($children as $child) {

									IF ( strtotime( $child->date() ) > $currentEpoch 
										&& !in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) {

										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink().'">' . $child->title() . '</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
							$html .= '</li>';
						}
					}
					catch (Exception $e) { } // continue...
				}
			}
			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}


		/*******************************************************************************
		SECTION FOR SHOWING CURRENT TOPICS - PUBILSHED, BUT NOT YET ARCHIEVED
		*******************************************************************************/
		IF ( $currentPagesExist ) 
		{
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($currentLabel)) {
				$html .= '	<h2 class="plugin-label">' . $currentLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (ORDER_BY=='position') {

				FOREACH($parents as $parent) {

					IF ( strtotime( $parent->date() ) <= $currentEpoch 
						&& strtotime( $parent->date() ) > $archiveEpoch 
						&& !in_array($parent->category(), array($hiddenCategory,$adminCategory) ) ) 
					{
						$html .= '<li class="parent">';
						$html .= '	<h3>';
						$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
						$html .= '	</h3>';

						IF ( $parent->hasChildren() && $showCurrentChildren ) {

							$children = $parent->children();
							$html .= '<ul class="child">';

							FOREACH ($children as $child) {

								IF ( strtotime( $child->date() ) <= $currentEpoch 
									&& strtotime( $child->date() ) > $archiveEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) )  {

									$html .= '<li class="child">';
									$html .= '	<a class="child" href="' . $child->permalink() . '">' . $child->title() . '</a>';
									$html .= '</li>';
								}
							}
							$html .= '</ul>';
						}
						$html .= '</li>';
					}
				}
			}
			else {	// Pages order by date

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
						$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) <= $currentEpoch
							&& strtotime( $page->date() ) > $archiveEpoch 
							&& !(in_array($page->category(), array($hiddenCategory,$adminCategory) ) )
							&& !($page->isChild() ) ) {								
						
							$html .= '<li class="parent">';
							$html .= '	<h3>';						
							$html .= '		<a class="parent" href="' . $page->permalink() . '">' . $page->title() . '</a>';
							$html .= '	</h3>';

							$children = $page->children();

							IF ( $page->hasChildren() && $showCurrentChildren ) {

								$children = $page->children();
								$html .= '<ul class="child">';

								FOREACH ($children as $child) {

									IF ( strtotime( $child->date() ) <= $currentEpoch 
										&& strtotime( $child->date() ) > $archiveEpoch 
											&& !(in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) ) {

										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink().'">' . $child->title() . '</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
							$html .= '</li>';
						}
					}
					catch (Exception $e) { }	// Continue
				}
			}
			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}

		/*******************************************************************************
		SECTION FOR SHOWING ARCHIEVED TOPICS - PUBILSHED AND OLD ENOUGH TO BE ARCHIEVED.
		*******************************************************************************/
		IF ( $archivePagesExist && $displayArchiveSection ) 
		{
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($archiveLabel)) {
				$html .= '	<h2 class="plugin-label">' . $archiveLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (ORDER_BY=='position') {

				FOREACH($parents as $parent) {

					IF ( strtotime( $parent->date() ) <= $archiveEpoch 
						&& !in_array($parent->category(), array($hiddenCategory,$adminCategory) ) ) {

						$html .= '<li class="parent">';
						$html .= '	<h3>';
						$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
						$html .= '	</h3>';

						IF ( $parent->hasChildren() && $showArchiveChildren ) {

							$children = $parent->children();
							$html .= '<ul class="child">';

							FOREACH ($children as $child) {

								IF ( strtotime( $child->date() ) <= $archiveEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) )  {

									$html .= '<li class="child">';
									$html .= '	<a class="child" href="' . $child->permalink() . '">' . $child->title() . '</a>';
									$html .= '</li>';
								}
							}

							$html .= '</ul>';
						}
						//}
						$html .= '</li>';

						$countOfItems++;
						IF ($countOfItems >= $numberOfItems) { break; }						
					}

				}
			}
			else {	// Pages order by date

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
						$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) <= $archiveEpoch
								&& !(in_array($page->category(), array($hiddenCategory,$adminCategory) ) )
								&& !($page->isChild() ) ) {								

							$html .= '<li class="parent">';
							$html .= '	<h3>';						
							$html .= '		<a class="parent" href="' . $page->permalink() . '">' . $page->title() . '</a>';
							$html .= '	</h3>';

							$children = $page->children();

							IF ( $page->hasChildren() && $showArchiveChildren ) {

								$children = $page->children();
								$html .= '<ul class="child">';

								FOREACH ($children as $child) {

									IF ( strtotime( $child->date() ) <= $archiveEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory) ) ) ) {

										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink() . '">' . $child->title() . '</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
							$html .= '</li>';

							$countOfItems++;
							IF ($countOfItems >= $numberOfItems) { break; }	
						}
					}
					catch (Exception $e) {

					}
				}
			}
			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}
		return $html;
	}

}
