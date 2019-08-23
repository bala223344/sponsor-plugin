<div class="slider">

<?php
   $result = $wpdb->get_results("SELECT * FROM $table_name");



   foreach ($result as $print) {
     echo "

  <div>
    <div class='slider-container'>

        <img src='$print->url' width='450px'/> 
        <div class='slider-title'>$print->name</div>
        <div class='add-to-cart'>Add to cart</div>
        <div class='slider-title'>Description</div>

    </div>   
    </div>


      
     ";
   }
   ?>
   </div>
   <?php //wp_login_form();?>