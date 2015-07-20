<?php 
	// any new page must start with the page_header, it will include the correct files
	// so that the rezgo parser classes and functions will be available to your templates
	require('rezgo/include/page_header.php');
	
	// start a new instance of RezgoSite
	$site = new RezgoSite();
	
	if(isset($_REQUEST['parent_url'])) {
			$site->base = DIRECTORY_SEPARATOR . $_REQUEST['parent_url'];
	}
			
	if($_REQUEST['search'] == 'restore' && $_COOKIE['rezgo_search']) {
		$site->sendTo($_COOKIE['rezgo_search']);
	}
	
	// some code to handle the pagination
	if(!$_REQUEST['pg']) $_REQUEST['pg'] = 1;
	
	$start = ($_REQUEST['pg'] - 1) * REZGO_RESULTS_PER_PAGE;
	
	// we only want 11 responses, starting at our page number times item number
	$site->setTourLimit(REZGO_RESULTS_PER_PAGE + 1, $start);
?>

<?=$site->getTemplate('frame_header')?>

<?=$site->getTemplate('index')?>

<?=$site->getTemplate('frame_footer')?>