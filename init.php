<?php
/*
Plugin Name: Frenchise Redirection
Description: Frenchise Redirection via PostalCode
Version: 1.0
Author: Fazal-e-Mabood
Author URI: https://www.fiverr.com/paksoft18
*/

// Databse setup
register_activation_hook(__FILE__,'Franchise_Redirection_create_tabel');
function Franchise_Redirection_create_tabel(){
	global $wpdb;
$table_name = 'Franchise_Redirection';
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	postalcode tinytext NOT NULL,
	url varchar(55) DEFAULT '' NOT NULL,
	UNIQUE KEY id (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

// ShortCode Intregration

add_shortcode('FranchiseRedirection','my_test_fun');

function my_test_fun(){
	ob_start();
Franchise_Redirection_ShortCode();
$output_string=ob_get_contents();;
ob_end_clean();

return $output_string;
}
function Franchise_Redirection_ShortCode()
{ ?>

<style>
::-webkit-input-placeholder {
   text-align: center;
}
:-moz-placeholder { /* Firefox 18- */
   text-align: center;
}
::-moz-placeholder {  /* Firefox 19+ */
   text-align: center;
}
:-ms-input-placeholder {
   text-align: center;
}
.searchInput {
    background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    border-radius: 0 !important;
    box-sizing: border-box !important;
    color: #2f2f2f !important;
    font-size: 14px !important;
    height: 45px !important;
    outline: none !important;
    width: 113px !important;
    z-index: 1500 !important;
    float: left;
    text-align: center; 
}
.dac-sprite {
    background-image: url(http://www.kidspartyideas.net/search.png);
    /* background-repeat: no-repeat; */
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    display: inline-block;
    vertical-align: middle;
    width: 31px;
    height: 29px;
    margin-top: 10px;
}
.searchdiv {
    display: block;
    height: 50px;
    background-color: #fff;
    width: 202px;
}


/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 568px)
  and (-webkit-min-device-pixel-ratio: 2) {
.searchInput {
    background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    border-radius: 0 !important;
    box-sizing: border-box !important;
    color: #2f2f2f !important;
    font-size: 14px !important;
    height: 45px !important;
    outline: none !important;
    width: 113px !important;
    z-index: 1500 !important;
    float: left;
    text-align: center; 
}
.dac-sprite {
    background-image: url(http://www.kidspartyideas.net/search.png);
    /* background-repeat: no-repeat; */
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    display: inline-block;
    vertical-align: middle;
    width: 31px;
    height: 29px;
    margin-top: 10px;
}
.searchdiv {
    display: block;
    height: 50px;
    background-color: #fff;
    width: 202px;
}
}


/* Desktops and laptops ----------- */
@media only screen 
and (min-width : 1224px) {
.searchInput {
    background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    border-radius: 0 !important;
    box-sizing: border-box !important;
    color: #2f2f2f !important;
    font-size: 14px !important;
    height: 45px !important;
    outline: none !important;
    width: 113px !important;
    z-index: 1500 !important;
    float: left;
    text-align: center; 
}
.dac-sprite {
    background-image: url(http://www.kidspartyideas.net/search.png);
    /* background-repeat: no-repeat; */
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    display: inline-block;
    vertical-align: middle;
    width: 31px;
    height: 29px;
    margin-top: 10px;
}
.searchdiv {
    display: block;
    height: 50px;
    background-color: #fff;
    width: 202px;
}
}


</style>
<center>
<div class="searchdiv">
 
<div class="dac-sprite dac-search dac-header-search-btn" id="search-btn" style="
		float: left;
		margin-right: 9px;
"></div
<form onsubmit="load_my_ajax()">
<input   class="searchInput" type="text" maxlength="10"  name="postalcode"   placeholder="Enter Post Code"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Post Code'"  onkeydown="EnterKeyEvent()">
</form>
<br/>
<p id="ajax_response"></p>
</div>
</center>


<?php }
// Include Js
function my_jquery()
{
	wp_enqueue_script('ajax-script',plugins_url('/js/ajax.js',__FILE__),array( 'jquery' ));
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action('wp_enqueue_scripts','my_jquery');
add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );
function my_ajax_function()
{
	if(isset($_POST['postalcode'])){
	  global $wpdb;
	  $postalcode = $_POST['postalcode'];
	  $rows = $wpdb->get_results("SELECT id,postalcode,url from Franchise_Redirection where postalcode = '$postalcode'");
	  $url = $rows[0]->url;
	 if (!$url=NULL){

	   echo ($rows[0]->url) ;
	 }
	 else{
		 echo ('Not found') ;
	 }
	}
		 wp_die();
	 }


//menu items
add_action('admin_menu','Frenchise_Redirection_modifymenu');
function Frenchise_Redirection_modifymenu() {

	//this is the main item for the menu
	add_menu_page('Frenchise Redirection', //page title
	'Redirections', //menu title
	'administrator', //capabilities
	'Franchise_Redirection_list', //menu slug
	'Franchise_Redirection_list' //function
	);

	//this is a submenu
	add_submenu_page('Franchise_Redirection_list', //parent slug
	'Add New Redirection', //page title
	'Add New', //menu title
	'manage_options', //capability
	'Franchise_Redirection_create', //menu slug
	'Franchise_Redirection_create'); //function

	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update School', //page title
	'Update', //menu title
	'manage_options', //capability
	'Franchise_Redirection_update', //menu slug
	'Franchise_Redirection_update'); //function
}





define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'Redirection-list.php');
require_once(ROOTDIR . 'Redirection-create.php');
require_once(ROOTDIR . 'Redirection-update.php');