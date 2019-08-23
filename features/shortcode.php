<?php

defined( 'ABSPATH' ) or die(':)');


function child_sponsorship_stripe() {
	wp_enqueue_style( 'CS_stripe', plugins_url( '/../css/custom.css', __FILE__ ), array(), null, "all");
	wp_enqueue_style( 'CS_tinyslider', "https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css");
	//wp_enqueue_style( 'video_popup_close_icon', plugins_url( '/css/vp-close-icon/close-button-icon.css', __FILE__ ), array(), time(), "all");
	//wp_enqueue_style( 'oba_youtubepopup_css', plugins_url( '/css/YouTubePopUp.css', __FILE__ ), array(), time(), "all");

	wp_enqueue_script( 'CS_stripe', 'https://js.stripe.com/v3/');
	wp_enqueue_script( 'CS_tinyslider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/min/tiny-slider.js');
	
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
  $whatever = intval( $_POST['whatever'] );
  $_SESSION['DONOR_CART'] = array('prod_id' => 1, 'account_id' => 2);
  $whatever += 10;
  echo $whatever;
  die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );


function child_sponsorship_html() {

	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 
	
	include_once( dirname( __FILE__ )."/display_records.php");

?>


<form action="<?php esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" id="payment-form">

<input type="hidden" name="card-submitted" value="1"/>
  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
</form>
<?php


}
function child_sponsorship_handle_submit() {

	if($_POST['card-submitted']) {
		
			/* Load Stripe SDK */
			require_once(  dirname( __FILE__ ) . '/../vendor/autoload.php' );
		\Stripe\Stripe::setApiKey('sk_test_kx5SX3ZTnrDZbN57dEt85hNq00702JBtbu');
		$token = $_POST['stripeToken'];


	

		// Create a Customer
$customer = \Stripe\Customer::create(array(
    "email" => "paying.user@example.com",
    "source" => $token,
));



// Creates a subscription plan. This can also be done through the Stripe dashboard.
// You only need to create the plan once.
$subscription = \Stripe\Plan::create(array(
    "amount" => 3000,
    "interval" => "month",
    "currency" => "cad",
	"id" => "monthly1",
	"product" => [
		"name" => "monthly1"
	  ],
));

// Subscribe the customer to the plan
$subscription = \Stripe\Subscription::create(array(
    "customer" => $customer->id,
    "plan" => "monthly1"
));


$subscription = \Stripe\Plan::create(array(
    "amount" => 2000,
    "interval" => "month",
    "currency" => "cad",
	"id" => "monthly2",
	"product" => [
		"name" => "monthly2"
	  ],
));

// Subscribe the customer to the plan
$subscription = \Stripe\Subscription::create(array(
    "customer" => $customer->id,
    "plan" => "monthly2"
));


print_r($subscription);

		exit;
		
	}


	if($_GET['add_to_cart']) {

	}

}

function child_sponsorship_front(){


	//$media = 'good byo';

	//return $media;

	ob_start();
	child_sponsorship_handle_submit();
	child_sponsorship_html();

	return ob_get_clean();

}
add_action( 'wp_enqueue_scripts', 'child_sponsorship_stripe' );
add_shortcode('child-sponsorship-front', 'child_sponsorship_front');