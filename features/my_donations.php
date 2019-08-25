<?php
  include_once('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 




//unset($_SESSION['DONOR_CART']);

if(is_user_logged_in() ) {
  $current_user = wp_get_current_user();
  $result = $wpdb->get_results("SELECT * FROM $table_name where donor_user = '$current_user->user_login';");

  if($result) {
  foreach ($result as $print) {

?>


<div>
  <?php echo "
   <ul class='cart-row'>
   <li><img  class='img-children' src='$print->url' /> </li>
        <li class=''>$print->name - $print->location</li>
        <li class=''>$".number_format($print->price, 2)." / month </li>
        <li class=''><a class='link' href='/send-a-letter-to-child?child-name=$print->name&child-location=$print->location'> Send a letter to this child</a> </li>
        </ul>
        "; ?>
  </div>




  <?php
  }
  }else {
    echo '<div class="cart-empty">You haven\'t donated yet.</div>';
  }
 } else {?>
    Please <a href="/my-account">login</a> to proceed.
  <?php } ?>