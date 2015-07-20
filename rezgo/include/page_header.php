<?php
	define('REZGO_WP_DIR', str_replace('/wp-content/plugins/rezgo-online-booking-new/rezgo/include', '', dirname(__FILE__)));

  require_once(REZGO_WP_DIR.'/wp-load.php');
	require( 'config.rezgo.php' );
	require( 'class.rezgo.php' );
?>