<?php

function rezgo_iframe($args) {
    global $wp;
    // the pagename can hide under a couple different names
    $wp_current_page = $wp->query_vars['name'];
    if(empty($wp_current_page)){
        $wp_current_page = $wp->query_vars['pagename'];
    }
		
		// account for subdirectory installs
		if (REZGO_WP_DIR != $_SERVER['DOCUMENT_ROOT']) {
			$wp_current_page = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', REZGO_WP_DIR).'/'.$wp_current_page;
		}
		
    parse_str($wp->matched_query, $matched_query);
    foreach($matched_query as $k => $v) {
        $_REQUEST[$k] = urldecode($v);
    }

    if(empty($_REQUEST['mode'])){
        $_REQUEST['mode'] = 'index';
    }

    if($args) {
        foreach($args as $k => $v) {
            if(!$_REQUEST[$k]) {
                $_REQUEST[$k] = $v;
            }
        }
    }
		
		// after parsing shortcode vars, catch rezgo_page and set mode if true
		// only override to details if mode is currently index
		if ($_REQUEST['rezgo_page'] == 'tour_details' && $_REQUEST['mode'] == 'index') {
				$_REQUEST['mode'] = 'page_details';
		}

    rezgo_include_file('frame.php', array(
        'wp_current_page' => $wp_current_page
    ));
		
}

function rezgo_add_rewrite_rules($wp_rewrite) {

    $new_rules = array (
        // tour details page (general)
        '(.+?)/details/([0-9]+)/([^\/]+)/?$'
        => 'index.php?pagename=$matches[1]&com=$matches[2]&mode=page_details',

        // tour details page (date and option selected)
        '(.+?)/details/([0-9]+)/([^\/]+)/([0-9]+)/([^\/]+)/?$'
        => 'index.php?pagename=$matches[1]&com=$matches[2]&option=$matches[4]&date=$matches[5]&mode=page_details',

        '(.+?)/tag/([^\/]*)/?$'
        => 'index.php?pagename=$matches[1]&mode=index&tags=$matches[2]',
				
        '(.+?)/keyword/([^\/]*)/?$'
        => 'index.php?pagename=$matches[1]&mode=index&search_in=smart&search_for=$matches[2]',
				
        '(.+?)/supplier/([^\/]*)/?$'
        => 'index.php?pagename=$matches[1]&mode=index&cid=$matches[2]',

        '(.+?)/order/?$'
        => 'index.php?pagename=$matches[1]&mode=page_order',

        '(.+?)/book/?$'
        => 'index.php?pagename=$matches[1]&mode=page_book&sec=1&title=Book+Now',

        '(.+?)/complete/([^\/]*)/print/?$'
        => 'index.php?pagename=$matches[1]&mode=booking_complete_print&trans_num=$matches[2]',

        '(.+?)/complete/([^\/]*)/pdf/?$'
        => 'index.php?pagename=$matches[1]&mode=booking_complete_pdf&trans_num=$matches[2]',

        '(.+?)/complete/([^\/]*)/?$'
        => 'index.php?pagename=$matches[1]&mode=booking_complete&trans_num=$matches[2]',

        '(.+?)/terms/?$'
        => 'index.php?pagename=$matches[1]&mode=page_terms',
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


add_filter( 'template_include', 'rezgo_no_theme' ); 

function rezgo_no_theme( $template ) {
	
	global $wp;
	
	parse_str($wp->matched_query, $matched_query);
	
	// no header and footer for printable receipt and terms popup
	if ( $matched_query['mode'] == 'booking_complete_print' || $matched_query['mode'] == 'page_terms' ) {
		return dirname( __FILE__ ) . '/rezgo_blank_template.php'; 
	} else {
		return $template;
	}
	
	
}