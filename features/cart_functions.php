<?php
 	 
     setlocale(LC_MONETARY, 'en_US');  

   function get_details($id) {
    global $wpdb;
    $table_name = $wpdb->prefix . "child_sponsorship"; 
    $result = $wpdb->get_row("SELECT * FROM $table_name WHERE id='$id';");
    return $result;
   }