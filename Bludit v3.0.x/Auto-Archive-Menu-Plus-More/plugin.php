<?php

class pluginAutoArchiveMenuPlusMore extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
			'durationType'=>'month',
			'whatToDoAboutNothing'=>false,
			'fillInText'=>'',

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

	// Method called on the settings of the plugin on the admin area
	public function form()
	{
		global $L;

		$html = '';
		/********************************************************
			Global Options
		********************************************************/
		$html .= '<h3>'.$L->get('global-options-title').'</h3> ';
		// Define the duration type
		$html .= '<div>';
		$html .= '<label>'.$L->get('duration-type-label').'</label>';
		$html .= '<select name="durationType">';
		$html .= '<option value="week" '.($this->getValue('durationType')==='week'?'selected':'').'>'.$L->get('week').'</option>';
		$html .= '<option value="month" '.($this->getValue('durationType')==='month'?'selected':'').'>'.$L->get('month').'</option>';
		$html .= '<option value="year" '.($this->getValue('durationType')==='year'?'selected':'').'>'.$L->get('year').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('duration-type-tip').'</span>';
		$html .= '</div>';
		// What to do about nothing - i.e. when no content is due to appear
		$html .= '<div>';
		$html .= '<label>'.$L->get('nothing-label').'</label>';
		$html .= '<select name="whatToDoAboutNothing">';
		$html .= '<option value="true" '.($this->getValue('whatToDoAboutNothing')===true?'selected':'').'>'.$L->get('show-section-label').'</option>';
		$html .= '<option value="false" '.($this->getValue('whatToDoAboutNothing')===false?'selected':'').'>'.$L->get('hide-section-label').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('what-about-nothing-tip').'</span>';
		$html .= '</div>';
		// IF Section Label is shown and there is no content, display some fill-in text instead.
		$html .= '<div>';
		$html .= '<label>'.$L->get('fillin-text-label').'</label>';
		$html .= '<input id="jsfillInText" name="fillInText" type="text" value="'.$this->getValue('fillInText').'">';
		$html .= '<span class="tip">'.$L->get('fillin-text-tip').'</span>';
		$html .= '</div>';

		$html .= '<hr>';
		/********************************************************
			Options for STATIC Pages section
		********************************************************/		
		$html .= '<h3>'.$L->get('static-pages-options-title').'</h3> ';		
		// Enable/Disable STATIC Pages section
		$html .= '<div>';
		$html .= '<label>'.$L->get('display-static-pages-section').'</label>';
		$html .= '<select name="displayStaticPagesSection">';
		$html .= '<option value="true" '.($this->getValue('displayStaticPagesSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayStaticPagesSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('display-static-pages-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for Static Pages Section
		$html .= '<div>';
		$html .= '<label>'.$L->get('Static Label').'</label>';
		$html .= '<input id="jsstaticLabel" name="staticLabel" type="text" value="'.$this->getValue('staticLabel').'">';
		$html .= '<span class="tip">'.$L->get('static-label-tip').'</span>';
		$html .= '</div>';
		// Display 'Home Page' in Static Pages section
		$html .= '<div>';
		$html .= '<label>'.$L->get('home-link').'</label>';
		$html .= '<select name="homeLink">';
		$html .= '<option value="true" '.($this->getValue('homeLink')?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.(!$this->getValue('homeLink')?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('home-link-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			Options for UPCOMING section
		********************************************************/
		$html .= '<h3>'.$L->get('upcoming-section-title').'</h3>';

		// Enabled/Disabled
		$html .= '<div>';
		$html .= '<label>'.$L->get('display-upcoming-section').'</label>';
		$html .= '<select name="displayUpcomingSection">';
		$html .= '<option value="true" '.($this->getValue('displayUpcomingSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayUpcomingSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('display-upcoming-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for UPCOMING Section
		$html .= '<div>';
		$html .= '<label>'.$L->get('upcoming-label').'</label>';
		$html .= '<input id="jsupcominglabel" name="upcomingLabel" type="text" value="'.$this->getValue('upcomingLabel').'">';
		$html .= '<span class="tip">'.$L->get('upcoming-label-tip').'</span>';
		$html .= '</div>';
		// Show UPCOMING CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$L->get('show-upcoming-children').'</label>';
		$html .= '<select name="showUpcomingChildren">';
		$html .= '<option value="true" '.($this->getValue('showUpcomingChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showUpcomingChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('show-upcoming-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';

		/********************************************************
			Options for CURRENT section
		********************************************************/
		// Menu Label for CURRENT section
		$html .= '<h3>'.$L->get('current-section-title').'</h3>';
		$html .= '<div>';
		$html .= '<label>'.$L->get('current-label').'</label>';
		$html .= '<input id="jscurrentlabel" name="currentLabel" type="text" value="'.$this->getValue('currentLabel').'">';
		$html .= '<span class="tip">'.$L->get('current-label-tip').'</span>';
		$html .= '</div>';
		// Current after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$L->get('current-after').'</label>';
		$html .= '<input id="jscurentafter" name="currentAfter" type="number" value="'.$this->getValue('currentAfter').'">';
		$html .= '<span class="tip">'.$L->get('current-after-tip').'</span>';
		$html .= '</div>';
		// Show CURRENT CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$L->get('show-current-children').'</label>';
		$html .= '<select name="showCurrentChildren">';
		$html .= '<option value="true" '.($this->getValue('showCurrentChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showCurrentChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('show-current-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			Options for ARCHIEVE section
		********************************************************/
		// Section label
		$html .= '<h3>'.$L->get('archive-section-title').'</h3>';
		// Enable/Disable Archive section
		$html .= '<div>';
		$html .= '<label>'.$L->get('display-archive-section').'</label>';
		$html .= '<select name="displayArchiveSection">';
		$html .= '<option value="true" '.($this->getValue('displayArchiveSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayArchiveSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('display-archive-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for Archive section
		$html .= '<div>';
		$html .= '<label>'.$L->get('archive-label').'</label>';
		$html .= '<input id="jsarchivelabel" name="archiveLabel" type="text" value="'.$this->getValue('archiveLabel').'">';
		$html .= '<span class="tip">'.$L->get('archive-label-tip').'</span>';
		$html .= '</div>';
		// Archive after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$L->get('archive-after').'</label>';
		$html .= '<input id="jsarchiveAfter" name="archiveAfter" type="number" value="'.$this->getValue('archiveAfter').'">';
		$html .= '<span class="tip">'.$L->get('archive-after-tip').'</span>';
		$html .= '</div>';
		// Display X number of Archived items
		$html .= '<div>';
		$html .= '<label>'.$L->get('amount-of-items').'</label>';
		$html .= '<input id="jsnumberOfItems" name="numberOfItems" type="number" value="'.$this->getValue('numberOfItems').'">';
		$html .= '<span class="tip">'.$L->get('amount-of-items-tip').'</span>';
		$html .= '</div>';
		// Show ARCHIEVE CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$L->get('show-archive-children').'</label>';
		$html .= '<select name="showArchiveChildren">';
		$html .= '<option value="true" '.($this->getValue('showArchiveChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showArchiveChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('show-archive-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			More options for other functionality
		********************************************************/
		// Section label HEADER
		$html .= '<h3>'.$L->get('plus-some-section-title').'</h3>';
		// Hide pages from menu for a particular category
		$html .= '<div>';
		$html .= '<label>'.$L->get('hidden-category').'</label>';
		$html .= '<input id="jshiddenCategory" name="hiddenCategory" type="text" value="'.$this->getValue('hiddenCategory').'">';
		$html .= '<span class="tip">'.$L->get('hidden-category-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		// Enable/Disable Admin Stuff section
		$html .= '<div>';
		$html .= '<label>'.$L->get('display-admin-stuff-section').'</label>';
		$html .= '<select name="displayAdminStuffSection">';
		$html .= '<option value="true" '.($this->getValue('displayAdminStuffSection')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayAdminStuffSection')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('display-admin-stuff-section-tip').'</span>';
		$html .= '</div>';
		// Set a particular category to be for Admin Stuff
		$html .= '<div>';
		$html .= '<label>'.$L->get('admin-stuff-category').'</label>';
		$html .= '<input id="jsadminCategory" name="adminCategory" type="text" value="'.$this->getValue('adminCategory').'">';
		$html .= '<span class="tip">'.$L->get('admin-stuff-category-tip1').'</span>';
		$html .= '<span class="tip">'.$L->get('admin-stuff-category-tip2').'</span>';
		$html .= '</div>';
		// Menu Label for ADMIN STUFF Section
		$html .= '<div>';
		$html .= '<label>'.$L->get('admin-stuff-label').'</label>';
		$html .= '<input id="jsadminStufflabel" name="adminStuffLabel" type="text" value="'.$this->getValue('adminStuffLabel').'">';
		$html .= '<span class="tip">'.$L->get('admin-stuff-label-tip').'</span>';
		$html .= '</div>';	
		// Show Admin Stuff CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$L->get('show-admin-stuff-children').'</label>';
		$html .= '<select name="showAdminStuffChildren">';
		$html .= '<option value="true" '.($this->getValue('showAdminStuffChildren')===true?'selected':'').'>'.$L->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showAdminStuffChildren')===false?'selected':'').'>'.$L->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$L->get('show-admin-stuff-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';		

		return $html;
	}

	// Method called on the sidebar of the website
	public function siteSidebar()
	{
		global $L;
		global $url;
		global $site;
		global $pages;
		global $parents;
		global $login;
		// $login = new Login();					// added 3.0.0
		// $userRole = $user->role();

		/*******************************************************************************
		Lets fill some variables... in order of above.
		*******************************************************************************/

		// do we display upcoming items?
		$displayUpcomingSection = $this->getValue('displayUpcomingSection');
		IF ($displayUpcomingSection) {
			$upcomingLabel = $this->getValue('upcomingLabel');			
		}

		// 'showUpcomingChildren'=>true,
		$showUpcomingChildren = $this->getValue('showUpcomingChildren');
		// 'currentLabel'=>'Current',
		$currentLabel = $this->getValue('currentLabel');
		// what is the selected durationType
		$durationType = $this->getValue('durationType');
		// How much time passes from the published date before being current - should be less than archive values below.
		IF ($displayUpcomingSection) {$currentAfter = $this->getValue('currentAfter');}
		ELSE {$currentAfter = 0;}
		$currentEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$currentAfter $durationType");
		// 'showCurrentChildren'=>true,
		$showCurrentChildren = $this->getValue('showCurrentChildren');
		// 'archiveLabel'=>'Archive',
		$archiveLabel = $this->getValue('archiveLabel');
		// 'displayArchiveSection'=>true,
		$displayArchiveSection = $this->getValue('displayArchiveSection');
		// How may much time pass from the published date before archiving - should be greater than current values above.
		$archiveAfter = $this->getValue('archiveAfter');
		$archiveEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$archiveAfter $durationType");
		// Number of Archive Parent pages to show and a counter
		$numberOfItems = $this->getValue('numberOfItems');
		$countOfItems = 0;
		// 'showArchiveChildren'=>true
		$showArchiveChildren = $this->getValue('showArchiveChildren');
		// Hidden Category
		$hiddenCategory = $this->getValue('hiddenCategory');
		// 'displayAdminStuffSection'=>true,
		$displayAdminStuffSection = $this->getValue('displayAdminStuffSection');
		// Admin Category
		$adminCategory = $this->getValue('adminCategory');
		// Admin Stuff Menu Label
		$adminStuffLabel = $this->getValue('adminStuffLabel');
		// 'showAdminStuffChildren'=>true
		$showAdminStuffChildren = $this->getValue('showAdminStuffChildren');
		// Display Static Pages Section
		$displayStaticPagesSection = $this->getValue('displayStaticPagesSection');
		// Static Page Label
		$staticLabel = $this->getValue('staticLabel');

		// Page number the first one
		$pageNumber = 1;

		// Misc - Other variables
		$loginUserName = "";
		$onlyPublished = true; 
		
		// Get the list of pages
		$publishedPagesByDate = $pages->getList($pageNumber, -1, $onlyPublished); // -1 gets all pages
		$parents = buildParentPages();
		
		// Declare EXIST variables for each section to FALSE, upcoming, current & archive.
		$adminPagesExist = false;
		$upcomingPagesExist = false;
		$currentPagesExist = false;
		$archivePagesExist = false;
		
		// For each page, check IF applicable for ADMIN STUFF section, set variable to TRUE and break out of loop
		IF ( $displayAdminStuffSection)
			//&& in_array($Login->role(), array("editor","admin",true) )) 
			{
			FOREACH($parents as $parent) {
				IF ($parent->category() === $adminCategory) {
					$adminPagesExist = true;
					$loginUserName = ""; //$Login->username();
					break;
				}
			}			
		}
		IF (ORDER_BY=='position') {

			// For each page, check IF applicable for UPCOMING section, set variable to TRUE and break out of loop		
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) 
					&& strtotime( $parent->date() ) > $currentEpoch) {

					$upcomingPagesExist = true;
					break;
				}
			}
			// For each page, check IF applicable for CURRENT section, set variable to TRUE and break out of loop
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) 
					&& strtotime( $parent->date() ) > $archiveEpoch 
						&& strtotime( $parent->date() ) <= $currentEpoch ) {

					$currentPagesExist = true;
					break;
				}
			}
			// For each page, check IF applicable for ARCHIVE section, set variable to TRUE and break out of loop
			FOREACH($parents as $parent) {
				IF (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) 
					&& strtotime( $parent->date() ) <= $archiveEpoch ) {

					$archivePagesExist = true;
					break;
				}
			}
		}
		else {

			// For each page, check IF applicable for UPCOMING section, set variable to TRUE and break out of loop		
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory), true ) 
							&& strtotime( $page->date() ) > $currentEpoch) {

							$upcomingPagesExist = true;
							break;
						}
				}
				catch (Exception $e) { // Continue
				}
			}
			// For each page, check IF applicable for CURRENT section, set variable to TRUE and break out of loop
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory), true ) 
							&&	strtotime( $page->date() ) > $archiveEpoch 
								&& strtotime( $page->date() ) <= $currentEpoch ) {

							$currentPagesExist = true;
							break;
						}
				}
				catch (Exception $e) { // Continue
				}
			}
			// For each page, check IF applicable for ARCHIVE section, set variable to TRUE and break out of loop
			FOREACH($publishedPagesByDate as $pageKey) {
				try {
						$page = new Page($pageKey);
						IF (!in_array($page->category(), array($hiddenCategory,$adminCategory), true ) 
							&& strtotime( $page->date() ) <= $archiveEpoch ) {

							$archivePagesExist = true;
							break;
						}
				}
				catch (Exception $e) { // Continue
				}
			}
		}

		// HTML for sidebar
		$html  = '';
		// if (checkRole('admin') ) {
			// $html .= 'User is Admin or editor';
		// }
		
		/******************************************************************************
		SECTION FOR SHOWING STATIC PAGES as taken from the Static Pages plug-in.
		*******************************************************************************/
		IF ($displayStaticPagesSection) {

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
				IF ( !in_array($page->category(), array($hiddenCategory,$adminCategory), true ) ) {
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
		SECTION FOR PAGES PUBILSHED WITH CATEGORY FOR THE ADMIN
		*******************************************************************************/
		IF ( $adminPagesExist && $displayAdminStuffSection ) {
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($adminStuffLabel)) {
				$html .= '	<h2 class="plugin-label">' . $adminStuffLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (!$loginUserName == "") {
				$html .= 'Welcome '.$loginUserName;
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
		// Pages ordered by date - NOT for Admin Section by design
		
		/*******************************************************************************
		SECTION FOR SHOWING UPCOMING TOPICS - PUBILSHED, BUT NOT YET CURRENT
		*******************************************************************************/
		IF ( $upcomingPagesExist && $displayUpcomingSection ) {
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($upcomingLabel)) {
				$html .= '	<h2 class="plugin-label">' . $upcomingLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (ORDER_BY=='position') {

				FOREACH($parents as $parent) {

					IF ( strtotime( $parent->date() ) > $currentEpoch 
						&& !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {

						$html .= '<li class="parent">';
						$html .= '	<h3>';
						$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
						$html .= '	</h3>';

						IF ( $parent->hasChildren() && $showUpcomingChildren ) {

							$children = $parent->children();
							$html .= '<ul class="child">';

							FOREACH ($children as $child) {

								IF ( strtotime( $child->date() ) > $currentEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) )  {

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
			// Pages order by date
			else {

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
						$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) > $currentEpoch
								&& !(in_array($page->category(), array($hiddenCategory,$adminCategory), true ) )
									&& !($page->isChild() ) ) {								
						
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
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) ) {

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
					catch (Exception $e) {
							// Continue
					}
				}
			}

			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}


		/*******************************************************************************
		SECTION FOR SHOWING CURRENT TOPICS - PUBILSHED, BUT NOT YET ARCHIEVED
		*******************************************************************************/
		IF ( $currentPagesExist ) {
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
							&& !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {

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
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) )  {

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
			// Pages order by date
			else {

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
						$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) <= $currentEpoch
							&& strtotime( $page->date() ) > $archiveEpoch 
								&& !(in_array($page->category(), array($hiddenCategory,$adminCategory), true ) )
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
											&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) ) {

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
					catch (Exception $e) {
							// Continue
					}
				}
			}

			$html .= '		</ul>';
			$html .= '	</div>';
			$html .= '</div>';
		}

		/*******************************************************************************
		SECTION FOR SHOWING ARCHIEVED TOPICS - PUBILSHED AND OLD ENOUGH TO BE ARCHIEVED.
		*******************************************************************************/
		IF ( $archivePagesExist && $displayArchiveSection ) {
			$html .= '<div class="plugin plugin-pages">';

			IF (!empty($archiveLabel)) {
				$html .= '	<h2 class="plugin-label">' . $archiveLabel . '</h2>';
			}

			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			IF (ORDER_BY=='position') {

				FOREACH($parents as $parent) {

					IF ( strtotime( $parent->date() ) <= $archiveEpoch 
						&& !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {

						//IF ($countOfItems === $numberOfItems) { break; }

						$html .= '<li class="parent">';
						$html .= '	<h3>';
						$html .= '		<a class="parent" href="' . $parent->permalink() . '">' . $parent->title() . '</a>';
						$html .= '	</h3>';

						IF ( $parent->hasChildren() && $showArchiveChildren ) {

							$children = $parent->children();
							$html .= '<ul class="child">';

							FOREACH ($children as $child) {

								IF ( strtotime( $child->date() ) <= $archiveEpoch 
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) )  {

									$html .= '<li class="child">';
									$html .= '	<a class="child" href="' . $child->permalink() . '">' . $child->title() . '</a>';
									$html .= '</li>';
								}
							}

							$html .= '</ul>';
						}
						//}
						$html .= '</li>';
					}
					//$countOfItems++;
				}
			}
			// Pages order by date
			else {

				$pageNumber = 1;

				FOREACH ($publishedPagesByDate as $pageKey) {

					try {
							$page = new Page($pageKey);
						
						IF ( strtotime( $page->date() ) <= $archiveEpoch
								&& !(in_array($page->category(), array($hiddenCategory,$adminCategory), true ) )
									&& !($page->isChild() ) ) {								
						//IF ($countOfItems == $numberOfItems) { break; }
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
										&& !(in_array($child->category(), array($hiddenCategory,$adminCategory), true ) ) ) {

										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink() . '">' . $child->title() . '</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
						//}
							$html .= '</li>';
						}
					//$countOfItems++;
					}
					catch (Exception $e) {
							// Continue
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
