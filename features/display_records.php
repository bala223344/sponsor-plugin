<?php

$count = ($_SESSION['DONOR_CART'])?count($_SESSION['DONOR_CART']):0;
if($count) 
  $class = '';
else 
  $class = 'd-none';
//unset($_SESSION['DONOR_CART']);


?>
<div id="donor-cart " class="<?php echo $class ?>">
  You have <span id="donor-cart-count"> <?php echo $count; ?> </span> items in your cart.
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
        <div class='slider-title'>$print->name</div>
        ";
        if($_SESSION['DONOR_CART'] && in_array($print->id, $_SESSION['DONOR_CART'])) {
          echo "
          <div class='add-to-cart'>Added</div>
          ";
      }else {
        echo "
        <div class='add-to-cart clickable' rel='$print->id'>Add to cart</div>
        ";
       
        }
        echo "
        <div class='slider-title'>Description</div>

    </div>   
    </div>


      
     ";
   }
   ?>
   </div>
   <?php //wp_login_form();?>