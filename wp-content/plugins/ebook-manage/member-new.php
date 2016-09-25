<?php

	require_once("memberclass.php");
	$objMem = new memberClass();

	$addme=$_POST["addme"];
	global $wpdb;

	if($addme==1)
	{
		$objMem->addNewMember($table_name = $wpdb->prefix . "member",$_POST);
		header("Location:admin.php?page=myplug/muyplg.php&info=saved");
		exit;
	}
	else if($addme==2)
	{
		$objMem->updMember($table_name = $wpdb->prefix . "member",$_POST);
		header("Location:admin.php?page=myplug/muyplg.php&info=upd");
		exit;
	}

	$act=$_REQUEST["act"];
	if($act=="upd")
	{
		$recid=$_REQUEST["id"];
		$sSQL="select * from ".$table_name = $wpdb->prefix . "member where id=$recid";
		$result = $wpdb->get_results($sSQL);
		$result = $result[0];
		if (sizeof($result) > 0 )
		{
			$id        = $result->id;
			$name      = $result->fname;
			// $pass      = $result->passwd;
			$email     = $result->email;
			$contact   = $result->contactno;
			$add       = $result->address;
			$btn	   = "Update eBook";
			$hidval	   = 2;
		}
	}
	else
	{
		$btn	   ="Add New eBook";
		$id        = "";
		$name  	   = "";
		$email     = "";
		$contact   = "";
		$add       = "";
		$hidval	   = 1;
	}
?>
<div xmlns="http://www.w3.org/1999/xhtml" class="wrap nosubsub">

	<div class="icon32" id="icon-edit"><br/></div>
<h2>eBooks</h2>
<div id="col-left">
	<div class="col-wrap">
		<div>
			<div class="form-wrap">
				<h3>Add New eBook</h3>
				<form class="validate" action="admin.php?page=member_add" method="post" id="addtag">
					<div class="form-field">
						<label for="tag-name">Title</label>

						<input type="text" size="40" id="fname" name="fname" value="<?php echo $name; ?>"/>
					</div>
<!-- 					<div class="form-field">
						<label for="tag-slug">Password</label>
						<input type="password" size="40" value="<?php echo $pass; ?>" id="passwd" name="passwd"/>
					</div> -->
					<div class="form-field">
						<label for="email">Email</label>
						<input type="text" size="40" value="<?php echo $email; ?>" id="email" name="email"/>
					</div>
					<div class="form-field">
						<label for="tag-slug">Contact No</label>
						<input type="text" size="40" value="<?php echo $contact; ?>" id="contactno" name="contactno"/>
					</div>
					<!--div class="form-field">

						<label for="parent">Parent</label>
						<select class="postform" id="parent" name="parent">
							<option value="-1">None</option>
							<option value="1" class="level-0">Uncategorized</option>
						</select>
					</div-->

					<div class="form-field">
						<label for="tag-description">Description</label>
						<textarea cols="40" rows="5" id="address" name="address"/><?php echo $add; ?></textarea>
					</div>

					<p class="submit">
						<input type="submit" value="<?php echo $btn; ?>" class="button" id="submit" name="submit"/>
						<input type="hidden" name="addme" value=<?php echo $hidval;?> >
						<input type="hidden" name="id" value=<?php echo $id;?> >
					</p>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
