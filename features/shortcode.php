<?php

defined( 'ABSPATH' ) or die(':)');


function child_sponsorship_stripe() {
	wp_enqueue_style( 'CS_stripe', plugins_url( '/../css/custom.css', __FILE__ ), array(), null, "all");
	wp_enqueue_style( 'CS_tinyslider', "https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css");
	wp_enqueue_style( 'CS_modal', "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css");
	//wp_enqueue_style( 'video_popup_close_icon', plugins_url( '/css/vp-close-icon/close-button-icon.css', __FILE__ ), array(), time(), "all");
	//wp_enqueue_style( 'oba_youtubepopup_css', plugins_url( '/css/YouTubePopUp.css', __FILE__ ), array(), time(), "all");

	wp_enqueue_script( 'CS_stripe', 'https://js.stripe.com/v3/');
	wp_enqueue_script( 'CS_tinyslider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/min/tiny-slider.js');
	wp_enqueue_script( 'CS_modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js');
	
	//wp_enqueue_script( 'CS_slick', plugins_url( '/../js/slick.min.js', __FILE__ ), array(), time(), true);

	wp_enqueue_script( 'CS_custom', plugins_url( '/../js/custom.js', __FILE__ ), array(), time(), true);
	wp_localize_script( 'CS_custom', 'MyAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'my-special-string' )
	  ));

	//wp_enqueue_script( 'oba_youtubepopup_activate', plugins_url( '/js/stripe_form.js', __FILE__ ), array('jquery'), time(), false);


}

// The function that handles the AJAX request
function my_action_callback() {
  check_ajax_referer( 'my-special-string', 'security' );
 
if($_POST['remove_from_cart']) {
	
	$darr = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:array();
	if(in_array($_POST['prod_id'], $darr))
	if (($key = array_search($_POST['prod_id'], $darr)) !== false) {
		unset($darr[$key]);
	}
	 $_SESSION['DONOR_CART'] = $darr;
	 echo count($_SESSION['DONOR_CART']);

}else {
	$darr = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:array();
	if(!in_array($_POST['prod_id'], $_SESSION['DONOR_CART']))
		array_push($darr, $_POST['prod_id']);
	 $_SESSION['DONOR_CART'] = $darr;
	 echo count($_SESSION['DONOR_CART']);	
}
 
  die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );


function child_sponsorship_html() {

	
	
	include_once( dirname( __FILE__ )."/display_records.php");

?>
<?php
}



function child_sponsorship_cart_html() {
	
	include_once( dirname( __FILE__ )."/display_cart.php");
}

function child_sponsorship_my_donations_html() {
	
	include_once( dirname( __FILE__ )."/my_donations.php");
}
function child_sponsorship_checkout_html() {
	
	include_once( dirname( __FILE__ )."/checkout_form.php");
}

function child_sponsorship_checkout_submit() {

	include_once( dirname( __FILE__ )."/checkout_stripe_action.php");



}

function child_sponsorship_front(){


	ob_start();
	child_sponsorship_html();

	return ob_get_clean();

}
function child_sponsorship_cart(){


	ob_start();
	child_sponsorship_cart_html();
	return ob_get_clean();

}
function child_sponsorship_my_donations(){


	ob_start();
	child_sponsorship_my_donations_html();
	return ob_get_clean();

}

function child_sponsorship_checkout(){


	ob_start();
	child_sponsorship_checkout_html();
	child_sponsorship_checkout_submit();

	return ob_get_clean();

}
add_action( 'wp_enqueue_scripts', 'child_sponsorship_stripe' );
add_shortcode('child-sponsorship-front', 'child_sponsorship_front');
add_shortcode('child-sponsorship-cart', 'child_sponsorship_cart');
add_shortcode('child-sponsorship-checkout', 'child_sponsorship_checkout');
add_shortcode('child-sponsorship-my-donations', 'child_sponsorship_my_donations');
