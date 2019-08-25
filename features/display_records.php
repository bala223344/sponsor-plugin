<?php
  include('cart_functions.php');
	global $wpdb;
	$table_name = $wpdb->prefix . "child_sponsorship"; 
$count = ($_SESSION['DONOR_CART'])?count($_SESSION['DONOR_CART']):0;
if($count) 
  $class = '';
else 
  $class = 'd-none';
//unset($_SESSION['DONOR_CART']);


?>
<div id="donor-cart" class="<?php echo $class ?>">
<a href="/donor-cart"> You have<span id="donor-cart-count">   <?php echo $count; ?>    </span> items in your cart.</a>
</div>
<?php

$result = $wpdb->get_results("SELECT * FROM $table_name where (donor_user IS NULL OR donor_user = '');");
?>
<div class="slider">

<?php

   



   foreach ($result as $print) {
     echo "

  <div>
    <div class='slider-container'>

        <img src='$print->url' width='450px'/> 
        <div  class='slider-title'><a  href='#modal{$print->id}' rel='modal:open'>$print->name - $print->location</a></div>
        ";
        if($_SESSION['DONOR_CART'] && in_array($print->id, $_SESSION['DONOR_CART'])) {
          echo "
          <div class='add-to-cart'>Added</div>
          ";
      }else {
        echo "
        <div>
        <a class='add-to-cart clickable' rel='$print->id'>Add to cart</a>
        </div>
        ";
       
        }
        echo "
        <div id='modal{$print->id}' class='modal'>
            <div class='desc'>$print->description</div>

            <a class='add-to-cart clickable'>  $".number_format($print->price, 2)."  / month  </a>

             

    </div>

    </div>   
    </div>


      
     ";
   }
   ?>
   </div>
   <?php //wp_login_form();?>