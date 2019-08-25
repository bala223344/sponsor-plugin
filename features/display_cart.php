<?php
  include('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 

$result = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:null;

//unset($_SESSION['DONOR_CART']);

if($result) {
?>
<div>
  You have <span id="donor-cart-count"> <?php echo count($result); ?> </span> items in your cart.
</div>

<?php 
if ( is_user_logged_in() ) {
  echo 'Proceed to checkout';
} else {
  echo 'Please sign in to checkout';
};
?>
<div id="cart-records">

<?php


 
   foreach ($result as $id) {
    $print = get_details($id);
     echo "

  <div class='cart-row'>

        <img class='img-children' src='$print->url' /> 
        <div class='slider-title'>$print->name</div>
        <div class=''>$print->price</div>
        <a rel='$print->id' class='remove-from-cart'>Remove</a>
        ";
       
        echo "

    </div>


      
     ";
   }
   ?>
   </div>
  <?php } else {?>
    Your cart is empty.
  <?php } ?>