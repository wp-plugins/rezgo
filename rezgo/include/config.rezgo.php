<?php
/*
    ---------------------------------------------------------------------------
        Basic configuration options
    ---------------------------------------------------------------------------
*/

// Your company ID and your API KEY for the Rezgo API, they can both be found
// on the main settings page on the Rezgo back-end.
define("REZGO_CID", get_option('rezgo_cid'));
define("REZGO_API_KEY", get_option('rezgo_api_key'));

// RECAPTCHA API keys for the contact page (get recaptcha: http://www.google.com/recaptcha)
define("REZGO_CAPTCHA_PUB_KEY", get_option('rezgo_captcha_pub_key'));
define("REZGO_CAPTCHA_PRIV_KEY", get_option('rezgo_captcha_priv_key'));

// Path to the rezgo install on your server, the default is /rezgo in the root.
// this is used by the template includes as well as fetching files in the templates
define("REZGO_DIR", strstr(preg_replace('/(https?\:\/\/)/', '', WP_PLUGIN_URL), '/').'/rezgo-online-booking-new/rezgo');

// The web root you want to precede links, the default is "" (empty) for root
// to change to your own custom directory, add it like /my_directory or /my/directory
define("REZGO_URL_BASE", strstr(preg_replace('/(https?\:\/\/)/', '', WP_PLUGIN_URL), '/').'/rezgo-online-booking-new');

// The top level frame you want to use as a destination for your links
// works with top, blank, self, parent
define("REZGO_FRAME_TARGET", "top");

// Redirect page for fatal errors, set this to 0 to disable
define("REZGO_FATAL_ERROR_PAGE", 0);

// The number of results per search page, this is used exclusively by the templates
define("REZGO_RESULTS_PER_PAGE", get_option('rezgo_result_num'));

/*
    ---------------------------------------------------------------------------
        Advanced configuration options
    ---------------------------------------------------------------------------
*/

	// detect a mobile browser
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if($_COOKIE['show_standard'] != 'on' && (($_COOKIE['show_standard'] == 'mobile') || preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))) {
		define( "REZGO_MOBILE_XML",					1																						);
	}


// shopping cart lifespan
define("REZGO_CART_TTL", 86400);

define("REZGO_TEMPLATE", get_option('rezgo_template'));

// Forward secure booking pages to the rezgo white-label, set to 0 if you want to
// use your own domain for the secure pages
define("REZGO_FORWARD_SECURE", get_option('rezgo_forward_secure'));

// By default, rezgo will use your own site as the secure site if forwarding is disabled,
// if you want to use a different URL, then set it here (do not include https://)
define("REZGO_SECURE_URL", get_option('rezgo_secure_url'));

// Disable the header and footer passed from the XML gateway. Enable this if you are embedding
// rezgo inside your own design.  This is only used by the header and footer templates
define("REZGO_HIDE_HEADERS", 1);

// The address of the Rezgo XML, can use xml.rezgo.com or xml.beta.rezgo.com
define("REZGO_XML", 'xml.rezgo.com');

// The Rezgo XML version you want to use, this setting should not be changed
define("REZGO_XML_VERSION", "current");

/*
    ---------------------------------------------------------------------------
        Error and debug handling
    ---------------------------------------------------------------------------
*/

// Send errors to firebug via console (get firebug: http://getfirebug.com/)
define("REZGO_FIREBUG_ERRORS", 0);

// Display errors if they occur, disabled if you just want to send errors to firebug
define("REZGO_DISPLAY_ERRORS", 1);

// Stop the page loading if an error occurs
define("REZGO_DIE_ON_ERROR", 0);

// Output all XML transactions. THIS MUST BE SET TO 1 TO USE THE SETTINGS BELOW
define("REZGO_TRACE_XML", 0);

// Include calls to the XML Cache (repeat queries) in the XML output
define("REZGO_INCLUDE_CACHE_XML", 0);

// Send the XML requests to Firebug, to avoid disrupting the page design
define("REZGO_FIREBUG_XML", 1);

// Switch the commit XML debug for one more suited for AJAX
define("REZGO_SWITCH_COMMIT", 1);

// Stop the commit request so booking AJAX responses can be checked
define("REZGO_STOP_COMMIT", 1);

// Display the XML inline with the regular page content
define("REZGO_DISPLAY_XML", 0);

// Display the XML inline with the regular page content
define("REZGO_DISPLAY_RESPONSES", 0);

// Separate WordPress specific functionality 
define("REZGO_WORDPRESS", 1);


?>