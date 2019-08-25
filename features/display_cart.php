<?php
  include('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 

$result = ($_SESSION['DONOR_CART'])?$_SESSION['DONOR_CART']:null;

//unset($_SESSION['DONOR_CART']);

if($result) {
?>
<div id="cart-actions">

<?php 

if ( is_user_logged_in() ) {
  echo '<a class="link" href="/donor-checkout/">Proceed to checkout</a>';
} else {
  echo '<a class="link" href="/my-account/">Please sign in to checkout</a>';
};
?>
</div>

<div id="cart-records">

<?php


 
   foreach ($result as $id) {
    $print = get_details($id);
     echo "

  <ul class='cart-row'>

       <li> <img class='img-children' src='$print->url' /> </li>
        <li class='title'>$print->name <br /> <i>$print->location </i></li>
        <li class=''>$".number_format($print->price, 2)."  / month  </li>
        <li><a rel='$print->id' class='remove-from-cart '>Remove</a></li>
        ";
       
        echo "

    </ul>


      
     ";
   }
   ?>
   </div>
  <?php } else {?>
   <div class="cart-empty"> Your cart is empty.</div>
  <?php } ?>