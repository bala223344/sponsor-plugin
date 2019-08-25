<?php
/*
Plugin Name: Child Sponsorship complete
Description: Child sponsporship front-end, backend, stripe
Version: 0.0.1
Author: Chase
License: GPLv2 or later
*/


defined( 'ABSPATH' ) or die(':)');




 require_once dirname( __FILE__ ). '/admin/admin.php';
 register_activation_hook( __FILE__, 'child_sponsorship_install' );
 

 require_once dirname( __FILE__ ). '/features/shortcode.php';
 require_once dirname( __FILE__ ). '/features/shortcode_callbacks.php';

