<?php
  include_once('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 

$result = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:null;



//unset($_SESSION['DONOR_CART']);



if($_POST['card-submitted']) {
		
    /* Load Stripe SDK */

    require_once(  dirname( __FILE__ ) . '/../vendor/autoload.php' );
  \Stripe\Stripe::setApiKey('sk_test_kx5SX3ZTnrDZbN57dEt85hNq00702JBtbu');
  $token = $_POST['stripeToken'];

  $current_user = wp_get_current_user();

  $customer = \Stripe\Customer::create(array(
    "email" => $current_user->user_email,
    "source" => $token,
  ));

  foreach ($result as $id) {
    $print = get_details($id);
    $current_user = wp_get_current_user();

   
    
    try {
      // Create a Customer
 
      
      

      // Creates a subscription plan. This can also be done through the Stripe dashboard.
      // You only need to create the plan once.
      $subscription = \Stripe\Plan::create(array(
        "amount" => ($print->price * 100),
        "interval" => "month",
        "currency" => "usd",
      "id" => $print->stripename,
      "product" => [
        "name" => $print->stripename
        ],
      ));
      
      // Subscribe the customer to the plan
      $subscription = \Stripe\Subscription::create(array(
        "customer" => $customer->id,
        "plan" => $print->stripename
      ));
      
      


      // $subscription = \Stripe\Plan::create(array(
      //   "amount" => 2000,
      //   "interval" => "month",
      //   "currency" => "cad",
      // "id" => "monthly2",
      // "product" => [
      //   "name" => "monthly2"
      //   ],
      // ));
      
      // // Subscribe the customer to the plan
      // $subscription = \Stripe\Subscription::create(array(
      //   "customer" => $customer->id,
      //   "plan" => "monthly2"
      // ));
      
      
      $success = 1;

      //unset($_SESSION['DONOR_CART']);
      
      }catch (Exception $e) {
        echo $e->getMessage();
      }
        

    
  }



 


if($success == 1) {

  foreach ($result as $id) {
    $wpdb->query("UPDATE $table_name SET donor_user='$current_user->user_login' WHERE id='$id'");

  }
  //redirect to /my-donations
  wp_redirect('/my-donations');
}
  
}


