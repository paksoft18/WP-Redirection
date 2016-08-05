<?php
function Franchise_Redirection_create () {
$postalcode = $_POST["postalcode"];
$url = $_POST["url"];
//insert
if(isset($_POST['insert'])){
	global $wpdb;
	$wpdb->insert(
		'Franchise_Redirection', //table
		array('postalcode' => $postalcode,'url' => $url), //data
		array('%s','%s') //data format
	);
	$message.="Redirection inserted";
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/Franchise-Redirection/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Add New Redirection</h2>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<p>Enter the complete URL</p>
<table class='wp-list-table widefat fixed'>

<tr><th>PostalCode</th><td><input type="text" name="postalcode" value="<?php echo $name;?>"/></td></tr>
<tr><th>URL</th><td><input type="text" name="url" value="<?php echo $name;?>"/></td></tr>
</table>
<input type='submit' name="insert" value='Save' class='button'>
</form>
</div>
<?php
}
