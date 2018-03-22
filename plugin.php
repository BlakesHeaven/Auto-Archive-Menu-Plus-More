<?php

class pluginAutoArchiveMenuPlusMore extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
			'upcomingLabel'=>'Upcoming',
			'displayUpcomingSection'=>true,
			'showUpcomingChildren'=>true,
			'currentLabel'=>'Current',
			'currentAfterWeeks'=>4,
			'showCurrentChildren'=>true,
			'archiveLabel'=>'Archive',
			'displayArchiveSection'=>true,
			'archiveAfterWeeks'=>10,
			'amountOfItems'=>5,
			'showArchiveChildren'=>true,
			'hiddenCategory'=>'Hidden',
			'homeLink'=>true,
			'whatToDoAboutNothing'=>true,
			'fillInText'=>'',
			'displayStaticPagesSection'=>true,
			'staticLabel'=>'Static Pages'		
		);
	}

	// Method called on the settings of the plug-in on the Admin area
	public function form()
	{
		global $Language;
		$html = '';
		/********************************************************
			Options for UPCOMING section
		********************************************************/ 
		$html .= '<h3>"Upcoming" section settings</h3>';

		// Enabled/Disabled
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Display Upcoming Section').'</label>';
		$html .= '<select name="displayUpcomingSection">';
		$html .= '<option value="true" '.($this->getValue('displayUpcomingSection')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayUpcomingSection')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the upcoming section on the sidebar').'</span>';
		$html .= '</div>';
		// Label
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Upcoming Label').'</label>';
		$html .= '<input id="jsupcominglabel" name="upcomingLabel" type="text" value="'.$this->getValue('upcomingLabel').'">';
		$html .= '<span class="tip">'.$Language->get('This title is used for the published content that is coming up next.').'</span>';
		$html .= '<span class="tip">'.$Language->get('Content becomes visible from the published date if the status is published.').'</span>';
		$html .= '</div>';
		// Show CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show children').'</label>';
		$html .= '<select name="showUpcomingChildren">';
		$html .= '<option value="true" '.($this->getValue('showUpcomingChildren')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('showUpcomingChildren')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the Children section on the sidebar').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		
		/********************************************************
			Options for CURRENT section
		********************************************************/ 		
		//Label
		$html .= '<h3>"Current" section settings (Always displayed)</h3> ';
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Current Label').'</label>';
		$html .= '<input id="jscurrentlabel" name="currentLabel" type="text" value="'.$this->getValue('currentLabel').'">';
		$html .= '<span class="tip">'.$Language->get('This title is use for the published content that relevant to now.').'</span>';
		$html .= '</div>';
		//Current after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$Language->get('current after weeks').'</label>';
		$html .= '<input id="jscurentafterweeks" name="currentAfterWeeks" type="number" value="'.$this->getValue('currentAfterWeeks').'">';
		$html .= '<span class="tip">'.$Language->get('Content becomes current after X weeks from the published date.').'</span>';
		$html .= '</div>';
		// Show CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show children').'</label>';
		$html .= '<select name="showCurrentChildren">';
		$html .= '<option value="true" '.($this->getValue('showCurrentChildren')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('showCurrentChildren')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the Children section on the sidebar').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			Options for ARCHIEVE section
		********************************************************/ 
		// Enabled/Disabled
		$html .= '<h3>"Archive" section settings</h3> ';	
		// Enable/Disable Archive section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Display Archive Section').'</label>';
		$html .= '<select name="displayArchiveSection">';
		$html .= '<option value="true" '.($this->getValue('displayArchiveSection')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayArchiveSection')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the archive section on the sidebar').'</span>';
		$html .= '</div>';
		// Label for Archive section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Archive Label').'</label>';
		$html .= '<input id="jsarchivelabel" name="archiveLabel" type="text" value="'.$this->getValue('archiveLabel').'">';
		$html .= '<span class="tip">'.$Language->get('This title is use for the published content that has moved into the past and not current.').'</span>';
		$html .= '</div>';
		//Archive after X time, e.g. weeks
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Archive after how many weeks').'</label>';
		$html .= '<input id="jsarchiveafterweeks" name="archiveAfterWeeks" type="number" value="'.$this->getValue('archiveAfterWeeks').'">';
		$html .= '<span class="tip">'.$Language->get('Content becomes archived after X weeks from the published date.').'</span>';
		$html .= '</div>';
		// Display X number of Archived items
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Amount of items').'</label>';
		$html .= '<input id="jsamountOfItems" name="amountOfItems" type="number" value="'.$this->getValue('amountOfItems').'">';
		$html .= '<span class="tip">'.$Language->get('The number of items appearing under the Archive list to prevent uncontrolled growth.').'</span>';	
		$html .= '</div>';
		// Show CHILDREN or not
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show children').'</label>';
		$html .= '<select name="showArchiveChildren">';
		$html .= '<option value="true" '.($this->getValue('showArchiveChildren')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('showArchiveChildren')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the Children section on the sidebar').'</span>';
		$html .= '</div>';
		$html .= '<hr>';
		/********************************************************
			More options for other functionality
		********************************************************/ 		
		$html .= '<h3>"Plus Some" more options</h3> ';		
		// What to do about nothing - i.e. when no content is due to appear
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Nothing Label').'</label>';
		$html .= '<select name="whatToDoAboutNothing">';
		$html .= '<option value="true" '.($this->getValue('whatToDoAboutNothing')===true?'selected':'').'>'.$Language->get('Show Section Label').'</option>';
		$html .= '<option value="false" '.($this->getValue('whatToDoAboutNothing')===false?'selected':'').'>'.$Language->get('Hide Section Label').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Handles whether to show/hide section label if empty. See below to display alternative text under label').'</span>';
		$html .= '</div>';
		// If Section Label is shown and there is no content, display some fill-in text instead.
		$html .= '<div>';
		$html .= '<label>'.$Language->get('fillin-text-label').'</label>';
		$html .= '<input id="jsfillInText" name="fillInText" type="text" value="'.$this->getValue('fillInText').'">';
		$html .= '<span class="tip">'.$Language->get('If selected to display fill-in text, show this text').'</span>';
		$html .= '</div>';	
		// Added to hide pages from menu for a particular category
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Hidden Category').'</label>';
		$html .= '<input id="jshiddenCategory" name="hiddenCategory" type="text" value="'.$this->getValue('hiddenCategory').'">';
		$html .= '<span class="tip">'.$Language->get('Any content assigned this category will be hidden from the menu. NB: The category must already exist.').'</span>';
		$html .= '</div>';	
		
		$html .= '<hr>';
		// Enable/Disable STATIC Pages section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Display STATIC PAGES Section').'</label>';
		$html .= '<select name="displayStaticPagesSection">';
		$html .= '<option value="true" '.($this->getValue('displayStaticPagesSection')===true?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('displayStaticPagesSection')===false?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Enable to display the STATIC PAGES section on the sidebar').'</span>';
		$html .= '</div>';
		// Label for Static Pages Section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Static Label').'</label>';
		$html .= '<input id="jsstaticLabel" name="staticLabel" type="text" value="'.$this->getValue('staticLabel').'">';
		$html .= '<span class="tip">'.$Language->get('The static page menu is almost always used in the sidebar of the site').'</span>';
		$html .= '</div>';
		// Display 'Home Page' in Static Pages section
		$html .= '<div>';
		$html .= '<label>'.$Language->get('Home Link').'</label>';
		$html .= '<select name="homeLink">';
		$html .= '<option value="true" '.($this->getValue('homeLink')?'selected':'').'>'.$Language->get('Enabled').'</option>';
		$html .= '<option value="false" '.(!$this->getValue('homeLink')?'selected':'').'>'.$Language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$Language->get('Show the home link on the sidebar - appears at the top of this plug-in in the static pages section').'</span>';
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
		// How may weeks pass from the published date before being current - should be less than archive values below.
		IF ($displayUpcomingSection) {$currentAfterWeeks = $this->getValue('currentAfterWeeks');}
		ELSE {$currentAfterWeeks = 0;}
		$currentEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$currentAfterWeeks week");
			// 'showCurrentChildren'=>true,
		$showCurrentChildren = $this->getValue('showCurrentChildren');
			// 'archiveLabel'=>'Archive',
		$archiveLabel = $this->getValue('archiveLabel');
			// 'displayArchiveSection'=>true,
		$displayArchiveSection = $this->getValue('displayArchiveSection');
		// How may weeks pass from the published date before archiving - should be greater than current values above.
		$archiveAfterWeeks = $this->getValue('archiveAfterWeeks');
		$archiveEpoch = strtotime(date("Y-m-d H:i:s", time() ) . " -$archiveAfterWeeks week");
		// Number of Archive Parent pages to show and a counter
		$amountOfItems = $this->getValue('amountOfItems');
		$countOfItems = 0;				
		// 'showArchiveChildren'=>true
		$showArchiveChildren = $this->getValue('showArchiveChildren');
		// Hidden Category
		$hiddenCategory = $this->getValue('hiddenCategory');

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
		$upcomingPagesExist = false;
		$currentPagesExist = false;
		$archivePagesExist = false;
		
		// For each page, check if applicable for UPCOMING section, set variable to TRUE and break out loop
		foreach($pagesByParent[PARENT] as $Parent) {
					if ($Parent->category()!= $hiddenCategory && 	strtotime( $Parent->date() ) > $currentEpoch) {
						$upcomingPagesExist = true;
						break;
					}
		}
		// For each page, check if applicable for CURRENT section, set variable to TRUE and break out loop
		foreach($pagesByParent[PARENT] as $Parent) {
					if ($Parent->category()!= $hiddenCategory &&	strtotime( $Parent->date() ) > $archiveEpoch && 
																	strtotime( $Parent->date() ) <= $currentEpoch ) {
						$currentPagesExist = true;
						break;
					}
		}
		// For each page, check if applicable for ARCHIVE section, set variable to TRUE and break out loop
		foreach($pagesByParent[PARENT] as $Parent) {
					if ($Parent->category()!= $hiddenCategory && 	strtotime( $Parent->date() ) <= $archiveEpoch ) {
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

				if ($page->category()!= $hiddenCategory ) {
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
		SECTION FOR SHOWING UPCOMING TOPICS - PUBILSHED, BUT NOT YET CURRENT
		*******************************************************************************/
		if ( $displayUpcomingSection && $upcomingPagesExist ) {
			$html .= '<div class="plugin plugin-pages">';
			$html .= '	<h2 class="plugin-label">'.$this->getValue('upcomingLabel').'</h2>';
			$html .= '	<div class="plugin-content">';
			$html .= '		<ul>';

			if(ORDER_BY==='position') {
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						if (strtotime( $Parent->date() ) > $currentEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$Parent->permalink().'">';
							$html .= 			$Parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							if ($showUpcomingChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';

									// Get keys of pages
									foreach($pagesByParent[$Parent->key()] as $child) {
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
							}
							$html .= '</li>';
						}
					}
				}
			}
			else {
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						if ( strtotime( $Parent->date() ) > $currentEpoch  ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$Parent->permalink().'">';
							$html .= 			$Parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							if ($showUpcomingChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';			

									// Get keys of pages
									foreach($pagesByParent[$Parent->key() ] as $child) {

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
							}
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
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						if (strtotime( $Parent->date() ) > $archiveEpoch && strtotime( $Parent->date() ) <= $currentEpoch ) {
							$html .= '<li class="parent">';
								$html .= '	<h3>';
								$html .= '		<a class="child" href="'.$Parent->permalink().'">';
								$html .= 			$Parent->title();
								$html .= '		</a>';
								$html .= '	</h3>';

							if ($showCurrentChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';

									// Get keys of pages
									foreach($pagesByParent[$Parent->key()] as $child) {

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
							}
							$html .= '</li>';
						}
					}
				}
			}
			else {
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						if (strtotime( $Parent->date() ) > $archiveEpoch && strtotime( $Parent->date() ) <= $currentEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$Parent->permalink().'">';
							$html .= 			$Parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							if ($showCurrentChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';			

									// Get keys of pages
									foreach($pagesByParent[$Parent->key() ] as $child) {

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
							}
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
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						//if ($countOfItems === $amountOfItems) { break; }
					
						if (strtotime( $Parent->date() ) <= $archiveEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$Parent->permalink().'">';
							$html .= 			$Parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							if ($showArchiveChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';

									// Get keys of pages
									foreach($pagesByParent[$Parent->key()] as $child) {

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
							}
							$html .= '</li>';
						}
						//$countOfItems++;
					}
				}
			}
			else {
				foreach($pagesByParent[PARENT] as $Parent) {

					if ($Parent->category()!= $hiddenCategory) {
						//if ($countOfItems === $amountOfItems) { break; }

						if (strtotime( $Parent->date() ) <= $archiveEpoch ) {
							$html .= '<li class="parent">';
							$html .= '	<h3>';
							$html .= '		<a class="child" href="'.$Parent->permalink().'">';
							$html .= 			$Parent->title();
							$html .= '		</a>';
							$html .= '	</h3>';

							if ($showArchiveChildren) {
								if(!empty($pagesByParent[$Parent->key()])) {
									$html .= '<ul class="child">';			

									// Get keys of pages
									foreach($pagesByParent[$Parent->key() ] as $child) {

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
							}
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