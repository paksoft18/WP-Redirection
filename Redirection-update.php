<?php
function Franchise_Redirection_update () {
global $wpdb;
$id = $_GET["id"];
$postalcode = $_POST["postalcode"];
$url=$_POST["url"];
//update
if(isset($_POST['update'])){
	var_dump($postalcode);
	$wpdb->update(
		'Franchise_Redirection', //table
		array('postalcode' => $postalcode,
		      'url' => $url), //data
		array( 'id' => $id ), //where
		array('%s'), //data format
		array('%s') //where format
	);
}
//delete
else if(isset($_POST['delete'])){
	$wpdb->query($wpdb->prepare("DELETE FROM Franchise_Redirection WHERE id = %s",$id));
}
else{//selecting value to update
	$redirections = $wpdb->get_results($wpdb->prepare("SELECT id,postalcode,url from Franchise_Redirection where id=%s",$id));
	foreach ($redirections as $s ){
		$postalcodeValue=$s->postalcode;
		$urlValue=$s->url;

	}
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/Franchise-Redirection/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Redirections</h2>

<?php if($_POST['delete']){?>
<div class="updated"><p>Redirection deleted</p></div>
<a href="<?php echo admin_url('admin.php?page=Franchise_Redirection_list')?>">&laquo; Back to Redirections list</a>

<?php } else if($_POST['update']) {?>
<div class="updated"><p>Redirection updated</p></div>
<a href="<?php echo admin_url('admin.php?page=Franchise_Redirection_list')?>">&laquo; Back to Redirections list</a>

<?php } else {?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
	<tr><th>PostalCode</th><td><input type="text" name="postalcode" value="<?php echo $postalcodeValue;?>"/></td></tr>
	<tr><th>URL</th><td><input type="text" name="url" value="<?php echo $urlValue;?>"/></td></tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
<input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure you want to delete the record?')">
</form>
<?php }?>

</div>
<?php
}
