<?php
  include_once('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 

$result = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:null;



//unset($_SESSION['DONOR_CART']);

if($result && is_user_logged_in() ) {


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



  <?php } else {?>
    Your cart is empty or you are not logged in.
  <?php } ?>