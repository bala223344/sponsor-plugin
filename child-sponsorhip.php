<?php
/*
Plugin Name: Child Sponsorship complete
Description: Child sponsporship front-end, backend, stripe
Version: 0.0.1
Author: Chase
License: GPLv2 or later
*/


defined( 'ABSPATH' ) or die(':)');


// function video_popup_load_textdomain() {
// }
// add_action( 'plugins_loaded', 'video_popup_load_textdomain' );


// function video_popup_plugin_row_meta( $links, $file ) {
// 	if ( strpos( $file, 'video-popup.php' ) !== false ) {
// 		$new_links = array(
// 						'<a title="'.esc_attr__("Need help? Support? Questions? Read the Explanation of Use.", "video-popup").'" href="https://wp-plugins.in/VideoPopUp-Usage" target="_blank">'.__("Explanation of Use", "video-popup").'</a>',
// 						'<a href="https://wp-plugins.in" target="_blank">'.__("More Plugins", "video-popup").'</a>',
// 						'<a class="vp-aff-link vp-aff-et" title="Get collection of 88 WordPress themes for $80 only! Try it, a 30-Day Money Back Guarantee!" href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=24967&tid1=vp_plugin_meta&url=35248" target="_blank">Elegant Themes</a>',
// 						'<a class="vp-aff-link vp-aff-divi" title="'.esc_attr__("The Ultimate WordPress Theme & Visual Page Builder. Try it, a 30-Day Money Back Guarantee!", "video-popup").'" href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=24967&url=21533&tid1=vp_plugin_meta_divi" target="_blank">'.__("Divi Theme", "video-popup").'</a>',
// 						'<a class="vp-aff-link vp-aff-sg" title="Fastest SSD Web and WordPress Hosting. Try it, a 30-Day Money Back Guarantee!" href="https://www.siteground.com/go/vp_plugin_meta" target="_blank">SiteGround</a>'
// 					);
		
// 		$links = array_merge( $links, $new_links );
// 	}
	
// 	return $links;
// }
// add_filter( 'plugin_row_meta', 'video_popup_plugin_row_meta', 10, 2 );


// function video_popup_plugin_action_links( $actions, $plugin_file ){
	
// 	static $plugin;

// 	if ( !isset($plugin) ){
// 		$plugin = plugin_basename(__FILE__);
// 	}
		
// 	if ($plugin == $plugin_file) {
		
// 		$new_links = array(
// 						'<a title="'.esc_attr__("Get it at a low price! Unlock all the features. Easy to use, download it, install it, activate it, and enjoy! Get it now!", "video-popup").'" class="vp-premium-extension-link_plm" href="https://wp-plugins.in/Get-VP-Premium-Extension" target="_blank">'.__('Get The Premium Extension', 'video-popup').'</a>',
// 						'<a href="'.admin_url("/admin.php?page=video_popup_general_settings").'">'.__("Settings", "video-popup").'</a>'
// 					);
		
// 		$actions = array_merge($new_links, $actions);
			
// 	}
	
// 	return $actions;
	
// }
// add_filter( 'plugin_action_links', 'video_popup_plugin_action_links', 10, 5 );



 require_once dirname( __FILE__ ). '/admin/admin.php';
 register_activation_hook( __FILE__, 'child_sponsorship_install' );
 

// require_once dirname( __FILE__ ). '/enqueue-scripts.php';

 require_once dirname( __FILE__ ). '/features/shortcode.php';
 require_once dirname( __FILE__ ). '/features/shortcode_callbacks.php';

