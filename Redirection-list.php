<?php
function Franchise_Redirection_list () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/Franchise-Redirection/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Redirections</h2>

<a href="<?php echo admin_url('admin.php?page=Franchise_Redirection_create'); ?>">Add New</a>
<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT id,postalcode,url from Franchise_Redirection");
echo "<table class='wp-list-table widefat fixed'>";
echo "<tr><th>ID</th><th>PostalCode</th><th>URL</th><th>Actions</th></tr>";
foreach ($rows as $row ){
	echo "<tr>";
	echo "<td>$row->id</td>";
	echo "<td>$row->postalcode</td>";
	echo "<td>$row->url</td>";
	echo "<td><a href='".admin_url('admin.php?page=Franchise_Redirection_update&id='.$row->id)."'>Update</a></td>";
	echo "</tr>";}
echo "</table>";
?>
</div>
<?php
}
