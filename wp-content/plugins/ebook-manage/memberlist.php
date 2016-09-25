<?php

	global $wpdb;

	$table_name = $wpdb->prefix . "member";

	$info=$_REQUEST["info"];

	if($info=="saved")
	{
		echo "<div class='updated' id='message'><p><strong>eBook Added</strong>.</p></div>";
	}

	if($info=="upd")
	{
		echo "<div class='updated' id='message'><p><strong>Record Updated</strong>.</p></div>";
	}

	if($info=="del")
	{
		$delid=$_GET["did"];
		$wpdb->query("delete from ".$table_name." where id=".$delid);
		echo "<div class='updated' id='message'><p><strong>Record Deleted.</strong>.</p></div>";
	}

?>

<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function(){
		jQuery('#memberlist').dataTable();
	});
	/* ]]> */

</script>


<div class="wrap">
    <h2>Manage eBooks <a class="button add-new-h2" href="admin.php?page=member_add&act=add">Add New</a></h2>
	 <table class="wp-list-table widefat fixed " id="memberlist">
		<thead>
			<tr>
				<th><u>ID</u></th>
				<th><u>Title</u></th>
				<th><u>URL</u></th>
				<th><u>Contact No</u></th>
				<th><u>Description</u></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
		$sql = "select * from ".$table_name." order by id desc";
		$arrresult = $wpdb->get_results($sql);
		
		if (sizeof($arrresult) > 0 )
		{

		?>
				<script type="text/javascript">
				/* <![CDATA[ */
				jQuery(document).ready(function(){
					jQuery('#mytable').dataTable();
				});
				/* ]]> */

				</script>

<?php
			
			foreach($arrresult as $key => $val)
			{
				$id        = $val->id;
				$fullname  = $val->fname;
				$email      = $val->email;
				$contact   = $val->contactno;
				$add       = $val->address;
	?>
			<tr>
				<td><?php echo ++$key; ?></td>
				<td nowrap><?php echo $fullname; ?></td>
				<td nowrap><?php echo $email; ?></td>
				<td><?php echo $contact; ?></td>
				<td><?php echo $add; ?></td>
				<td><u><a href="admin.php?page=member_add&act=upd&id=<?php echo $id;?>">Edit</a></u></td>
				<td><u><a href="admin.php?page=myplug/muyplg.php&info=del&did=<?php echo $id;?>">Delete</a></u></td>
			</tr>
<?php }
	} else { ?>
			<tr>
				<td>No Record Found!</td>
			<tr>
	<?php } ?>
	</tbody>
	</table>
</div>
