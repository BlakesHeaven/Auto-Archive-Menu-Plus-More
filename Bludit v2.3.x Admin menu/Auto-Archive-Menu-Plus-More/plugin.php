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
			'amountOfItems'=>5,
			'showArchiveChildren'=>true,

			'hiddenCategory'=>'Hidden',

			'displayAdminStuffSection'=>true,
			'adminCategory'=>'Admin Stuff',
			'adminStuffLabel'=>'Admin Stuff',
			'showAdminStuffChildren'=>true
		);
	}

	// Method called on the settings of the plug-in on the Admin area
	public function form()
	{
		global $Language;
		$html = '';
		/********************************************************
			Global Options
		********************************************************/
		$html .= '<h3>'.$Language->get('global-options-title').'</h3> ';
		// Define the duration type
		$html .= '<div>';
		$html .= '<label>'.$Language->get('duration-type-label').'</label>';
		$html .= '<select name="durationType">';
		$html .= '<option value="week" '.($this->getValue('durationType')==='week'?'selected':'').'>'.$Language->get('week').'</option>';
		$html .= '<option value="month" '.($this->getValue('durationType')==='month'?'selected':'').'>'.$Language->get('month').'</option>';
		$html .= '<option value="year" '.($this->getValue('durationType')==='year'?'selected':'').'>'.$Language->get('year').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('duration-type-tip').'</span>';
		$html .= '</div>';
		// What to do about nothing - i.e. when no content is due to appear
		$html .= '<div>';
		$html .= '<label>'.$Language->get('nothing-label').'</label>';
		$html .= '<select name="whatToDoAboutNothing">';
		$html .= '<option value="true" '.($this->getValue('whatToDoAboutNothing')===true?'selected':'').'>'.$Language->get('show-section-label').'</option>';
		$html .= '<option value="false" '.($this->getValue('whatToDoAboutNothing')===false?'selected':'').'>'.$Language->get('hide-section-label').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('what-about-nothing-tip').'</span>';
		$html .= '</div>';
		// If Section Label is shown and there is no content, display some fill-in text instead.
		$html .= '<div>';
		$html .= '<label>'.$Language->get('fillin-text-label').'</label>';
		$html .= '<input id="jsfillInText" name="fillInText" type="text" value="'.$this->getValue('fillInText').'">';
		$html .= '<span class="tip">'.$Language->get('fillin-text-tip').'</span>';
		$html .= '</div>';

		$html .= '<hr>';
		/********************************************************
			Options for STATIC Pages section
		********************************************************/		
		$html .= '<h3>'.$Language->get('static-pages-options-title').'</h3> ';		
		// Enable/Disable STATIC Pages section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('display-static-pages-section').'</label>';
		$html .= '<select name="displayStaticPagesSection">';
		$html .= '<option value="true" '.($this->getValue('displayStaticPagesSection')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayStaticPagesSection')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('display-static-pages-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for Static Pages Section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Static Label').'</label>';
		$html .= '<input id="jsstaticLabel" name="staticLabel" type="text" value="'.$this->getValue('staticLabel').'">';
		$html .= '<span class="tip">'.$Language->get('static-label-tip').'</span>';
		$html .= '</div>';
		// Display 'Home Page' in Static Pages section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('home-link').'</label>';
		$html .= '<select name="homeLink">';
		$html .= '<option value="true" '.($this->getValue('homeLink')?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.(!$this->getValue('homeLink')?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('home-link-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			Options for UPCOMING section
		********************************************************/
		$html .= '<h3>'.$Language->get('upcoming-section-title').'</h3>';

		// Enabled/Disabled
		$html .= '<div>';
		$html .= '<label>'.$Language->get('display-upcoming-section').'</label>';
		$html .= '<select name="displayUpcomingSection">';
		$html .= '<option value="true" '.($this->getValue('displayUpcomingSection')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayUpcomingSection')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('display-upcoming-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for UPCOMING Section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('upcoming-label').'</label>';
		$html .= '<input id="jsupcominglabel" name="upcomingLabel" type="text" value="'.$this->getValue('upcomingLabel').'">';
		$html .= '<span class="tip">'.$Language->get('upcoming-label-tip').'</span>';
		$html .= '</div>';
		// Show UPCOMING CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('show-upcoming-children').'</label>';
		$html .= '<select name="showUpcomingChildren">';
		$html .= '<option value="true" '.($this->getValue('showUpcomingChildren')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showUpcomingChildren')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('show-upcoming-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';

		/********************************************************
			Options for CURRENT section
		********************************************************/
		// Menu Label for CURRENT section
		$html .= '<h3>'.$Language->get('current-section-title').'</h3>';
		$html .= '<div>';
		$html .= '<label>'.$Language->get('current-label').'</label>';
		$html .= '<input id="jscurrentlabel" name="currentLabel" type="text" value="'.$this->getValue('currentLabel').'">';
		$html .= '<span class="tip">'.$Language->get('current-label-tip').'</span>';
		$html .= '</div>';
		// Current after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$Language->get('current-after').'</label>';
		$html .= '<input id="jscurentafter" name="currentAfter" type="number" value="'.$this->getValue('currentAfter').'">';
		$html .= '<span class="tip">'.$Language->get('current-after-tip').'</span>';
		$html .= '</div>';
		// Show CURRENT CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('show-current-children').'</label>';
		$html .= '<select name="showCurrentChildren">';
		$html .= '<option value="true" '.($this->getValue('showCurrentChildren')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showCurrentChildren')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('show-current-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			Options for ARCHIEVE section
		********************************************************/
		// Section label
		$html .= '<h3>'.$Language->get('archive-section-title').'</h3>';
		// Enable/Disable Archive section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('display-archive-section').'</label>';
		$html .= '<select name="displayArchiveSection">';
		$html .= '<option value="true" '.($this->getValue('displayArchiveSection')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayArchiveSection')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('display-archive-section-tip').'</span>';
		$html .= '</div>';
		// Menu Label for Archive section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('archive-label').'</label>';
		$html .= '<input id="jsarchivelabel" name="archiveLabel" type="text" value="'.$this->getValue('archiveLabel').'">';
		$html .= '<span class="tip">'.$Language->get('archive-label-tip').'</span>';
		$html .= '</div>';
		// Archive after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$Language->get('archive-after').'</label>';
		$html .= '<input id="jsarchiveAfter" name="archiveAfter" type="number" value="'.$this->getValue('archiveAfter').'">';
		$html .= '<span class="tip">'.$Language->get('archive-after-tip').'</span>';
		$html .= '</div>';
		// Display X number of Archived items
		$html .= '<div>';
		$html .= '<label>'.$Language->get('amount-of-items').'</label>';
		$html .= '<input id="jsamountOfItems" name="amountOfItems" type="number" value="'.$this->getValue('amountOfItems').'">';
		$html .= '<span class="tip">'.$Language->get('amount-of-items-tip').'</span>';
		$html .= '</div>';
		// Show ARCHIEVE CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('show-archive-children').'</label>';
		$html .= '<select name="showArchiveChildren">';
		$html .= '<option value="true" '.($this->getValue('showArchiveChildren')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showArchiveChildren')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('show-archive-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			More options for other functionality
		********************************************************/
		// Section label HEADER
		$html .= '<h3>'.$Language->get('plus-some-section-title').'</h3>';
		// Hide pages from menu for a particular category
		$html .= '<div>';
		$html .= '<label>'.$Language->get('hidden-category').'</label>';
		$html .= '<input id="jshiddenCategory" name="hiddenCategory" type="text" value="'.$this->getValue('hiddenCategory').'">';
		$html .= '<span class="tip">'.$Language->get('hidden-category-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		// Enable/Disable Admin Stuff section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('display-admin-stuff-section').'</label>';
		$html .= '<select name="displayAdminStuffSection">';
		$html .= '<option value="true" '.($this->getValue('displayAdminStuffSection')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayAdminStuffSection')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('display-admin-stuff-section-tip').'</span>';
		$html .= '</div>';
		// Set a particular category to be for Admin Stuff
		$html .= '<div>';
		$html .= '<label>'.$Language->get('admin-stuff-category').'</label>';
		$html .= '<input id="jsadminCategory" name="adminCategory" type="text" value="'.$this->getValue('adminCategory').'">';
		$html .= '<span class="tip">'.$Language->get('admin-stuff-category-tip1').'</span>';
		$html .= '<span class="tip">'.$Language->get('admin-stuff-category-tip2').'</span>';
		$html .= '</div>';
		// Menu Label for ADMIN STUFF Section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('admin-stuff-label').'</label>';
		$html .= '<input id="jsadminStufflabel" name="adminStuffLabel" type="text" value="'.$this->getValue('adminStuffLabel').'">';
		$html .= '<span class="tip">'.$Language->get('admin-stuff-label-tip').'</span>';
		$html .= '</div>';	
		// Show Admin Stuff CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('show-admin-stuff-children').'</label>';
		$html .= '<select name="showAdminStuffChildren">';
		$html .= '<option value="true" '.($this->getValue('showAdminStuffChildren')===true?'selected':'').'>'.$Language->get('enable-section').'</option>';
		$html .= '<option value="false" '.($this->getValue('showAdminStuffChildren')===false?'selected':'').'>'.$Language->get('disable-section').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('show-admin-stuff-children-tip').'</span>';
		$html .= '</div>';
		$html .= '<hr>';		

		return $html;
	}

	// Method called on the sidebar of the website
	public function siteSidebar()
	{
		global $Language;
		global $Url;
		global $Site;
		global $dbPages;
		global $pagesByParent;
		global $Login;

		/*******************************************************************************
		Lets fill some variables... in order of above.
		*******************************************************************************/
		// 'upcomingLabel'=>'Upcoming',
		$upcomingLabel = $this->getValue('upcomingLabel');
		// do we display upcoming items?
		$displayUpcomingSection = $this->getValue('displayUpcomingSection');
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
		$amountOfItems = $this->getValue('amountOfItems');
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

		// Only published pages
		$onlyPublished = true;

		// Get the list of pages
		$pages = $dbPages->getList($pageNumber, $amountOfItems, $onlyPublished, true);
		$staticPages = $dbPages->getStaticDB(true);

		// Declare EXIST variables for each section to FALSE, upcoming, current & archive.
		$adminPagesExist = false;
		$upcomingPagesExist = false;
		$currentPagesExist = false;
		$archivePagesExist = false;


		$pagesByParent = buildParentPages(); 			// added 2.3.4

		// For each page, check if applicable for ADMIN STUFF section, set variable to TRUE and break out loop
		IF ( in_array($Login->role(), array("editor","admin",true) )) {
			foreach($pagesByParent as $parent) {
				if ($parent->category() === $adminCategory) {
					$adminPagesExist = true;
					break;
				}
			}			
		}

		// For each page, check if applicable for UPCOMING section, set variable to TRUE and break out loop		
		foreach($pagesByParent as $parent) {
			if (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) &&	
															strtotime( $parent->date() ) > $currentEpoch) {
				$upcomingPagesExist = true;
				break;
			}
		}
		// For each page, check if applicable for CURRENT section, set variable to TRUE and break out loop
		foreach($pagesByParent as $parent) {
			if (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) &&	
															strtotime( $parent->date() ) > $archiveEpoch &&
															strtotime( $parent->date() ) <= $currentEpoch ) {
				$currentPagesExist = true;
				break;
			}
		}
		// For each page, check if applicable for ARCHIVE section, set variable to TRUE and break out loop
		foreach($pagesByParent as $parent) {			// 2.3.4 added
			if (!in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) &&
															strtotime( $parent->date() ) <= $archiveEpoch ) {
				$archivePagesExist = true;
				break;
			}
		}

		// HTML for sidebar
		$html  = '';
		/******************************************************************************
		SECTION FOR SHOWING STATIC PAGES as taken from the Static Pages plug-in.
		*******************************************************************************/
		if ($displayStaticPagesSection) {
			// HTML for sidebar
			$html .= '<div class="plugin plugin-pages">';
			$html .= '<h2 class="plugin-label">'.$staticLabel.'</h2>';
			$html .= '<div class="plugin-content">';
			$html .= '<ul>';

			// Show Home page link
			if ($this->getValue('homeLink')) {
				$html .= '<li>';
				$html .= '<a href="'.$Site->url().'">';
				$html .= $Language->get('Home page');
				$html .= '</a>';
				$html .= '</li>';
			}

			// Get keys of pages
			foreach ($staticPages as $pageKey) {
				// Create the page object from the page key
				$page = buildPage($pageKey);

				if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {
					$html .= '<li>';
					$html .= '<a href="'.$page->permalink().'">';
					$html .= $page->title();
					$html .= '</a>';
					$html .= '</li>';
				}
			}

			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
		}
		/*******************************************************************************
		SECTION FOR PAGES PUBILSHED WITH CATEGORY FOR THE ADMIN
		*******************************************************************************/
		if ( $displayAdminStuffSection && $adminPagesExist ) {
			$html .= '<div class="plugin plugin-pages">';
			$html .= '	<h2 class="plugin-label">'.$this->getValue('adminStuffLabel').'</h2>';
			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';
			$html .= 'Welcome '.$Login->username();
			foreach($pagesByParent as $parent) {

				//if ($parent->category()!= $hiddenCategory) {
				if ( $parent->category() === $adminCategory ) {

					$html .= '<li class="parent">';
					$html .= '	<h3>';
					$html .= '		<a class="child" href="'.$parent->permalink().'">';
					$html .= 			$parent->title();
					$html .= '		</a>';
					$html .= '	</h3>';

					if ( $showAdminStuffChildren && $parent->hasChildren()) {

						$pagesByChildren = $parent->children();

						$html .= '<ul class="child">';

						// Get keys of pages
						foreach ($pagesByChildren as $child) {

							// Create the page object from the page key if valid for this section.
							if (strtotime( $child->date() ) > $currentEpoch ) {
								$html .= '<li class="child">';
								$html .= '	<a class="child" href="'.$child->permalink().'">';
								$html .= 		$child->title();
								$html .= '	</a>';
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
		if ( $displayUpcomingSection && $upcomingPagesExist ) {
			$html .= '<div class="plugin plugin-pages">';
			$html .= '	<h2 class="plugin-label">'.$this->getValue('upcomingLabel').'</h2>';
			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			if(ORDER_BY==='position') {
				foreach($pagesByParent as $parent) {			// 2.3.4 added

					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {
					
						if (strtotime( $parent->date() ) > $currentEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showUpcomingChildren) {

							if ($showUpcomingChildren && $parent->hasChildren()) {						// 2.3.4 added

								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) > $currentEpoch ) {
										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
							//}
							$html .= '</li>';
						}
					}
				}
			}
			else {
				foreach($pagesByParent as $parent) {			// 2.3.4 added

					//if ($parent->category()!= $hiddenCategory) {
					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {

						if ( strtotime( $parent->date() ) > $currentEpoch  ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showUpcomingChildren) {
							if ($showUpcomingChildren && $parent->hasChildren()) {						// 2.3.4 added

								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) >= $currentEpoch ) {
										$html .= '<li>';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
										$html .= '</li>';
									}
								}
							}
							//}
							$html .= '</li>';
						}
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
		IF ($currentPagesExist) {
			$html .= '<div class="plugin plugin-pages">';
			$html .= '	<h2 class="plugin-label">'.$this->getValue('currentLabel').'</h2>';
			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			if(ORDER_BY==='position') {
				foreach($pagesByParent as $parent) {			// 2.3.4 added
					//if ($parent->category()!= $hiddenCategory) {

					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {

						if (strtotime( $parent->date() ) > $archiveEpoch && strtotime( $parent->date() ) <= $currentEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showCurrentChildren) {
							if ( $showCurrentChildren && $parent->hasChildren() ) {						// 2.3.4 added
								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) > $archiveEpoch && strtotime( $child->date() ) <= $currentEpoch ) {
										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
										$html .= '</li>';
									}
								}
								$html .= '</ul>';
							}
							//}
							$html .= '</li>';
						}
					}
				}
			}
			else {
				foreach($pagesByParent as $parent) {			// 2.3.4 added
					//if ($parent->category()!= $hiddenCategory) {

					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {
					
						if (strtotime( $parent->date() ) > $archiveEpoch && strtotime( $parent->date() ) <= $currentEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showCurrentChildren) {
							if ( $showCurrentChildren && $parent->hasChildren() ) {						// 2.3.4 added
								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) > $archiveEpoch && strtotime( $child->date() ) <= $currentEpoch ) {
										$html .= '<li>';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
										$html .= '</li>';
									}
								}
							}
							//}
							$html .= '</li>';
						}
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
		if ( $displayArchiveSection && $archivePagesExist ) {
			$html .= '<div class="plugin plugin-pages">';
			$html .= '	<h2 class="plugin-label">'.$this->getValue('archiveLabel').'</h2>';
			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';


			if(ORDER_BY==='position') {
				foreach($pagesByParent as $parent) {			// 2.3.4 added

					//if ($parent->category()!= $hiddenCategory) {
					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {
						
						//if ($countOfItems === $amountOfItems) { break; }

						if (strtotime( $parent->date() ) <= $archiveEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showArchiveChildren) {
							if ( $showArchiveChildren && $parent->hasChildren() ) {						// 2.3.4 added
								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) <= $archiveEpoch ) {
										$html .= '<li class="child">';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
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
			}
			else {
				foreach($pagesByParent as $parent) {			// 2.3.4 added

					//if ($parent->category()!= $hiddenCategory) {
					if ( !in_array($parent->category(), array($hiddenCategory,$adminCategory), true ) ) {
						
						//if ($countOfItems === $amountOfItems) { break; }

						if (strtotime( $parent->date() ) <= $archiveEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$parent->permalink().'">';
							$html .= 			$parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							//if ($showArchiveChildren) {
							if ( $showArchiveChildren && $parent->hasChildren() ) {						// 2.3.4 added
								$pagesByChildren = $parent->children();			// 2.3.4 added

								$html .= '<ul class="child">';

								// Get keys of pages
								foreach ($pagesByChildren as $child) {						// 2.3.4 added

									// Create the page object from the page key if valid for this section.
									if (strtotime( $child->date() ) <= $archiveEpoch ) {
										$html .= '<li>';
										$html .= '	<a class="child" href="'.$child->permalink().'">';
										$html .= 		$child->title();
										$html .= '	</a>';
										$html .= '</li>';
									}
								}
							}
							//}
							$html .= '</li>';
						}
						//$countOfItems++;
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
