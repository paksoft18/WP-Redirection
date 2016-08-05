<?php
//require_once('../wp-includes/wp-config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'wordpress/wp-config.php' );


if(isset($_POST['postalcode'])){
  global $wpdb;
  $postalcode = $_POST['postalcode'];
  $rows = $wpdb->get_results("SELECT id,postalcode,url from Franchise_Redirection where postalcode = $postalcode");
$url= $rows[0]->url;
 if (!$url=NULL){

   header("Location: $url");
 }


}


 ?>
