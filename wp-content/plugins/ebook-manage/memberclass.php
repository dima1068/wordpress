<?php

	class memberClass
	{

		private $myFields=array("id","fname","email","contactno","address");
// "passwd",
		function addNewMember($tblname,$meminfo)
		{
			global $wpdb;
			$count = sizeof($meminfo);
			if($count>0)
			{
				$id=0;
				$field="";
				$vals="";

				foreach($this->myFields as $key)
				{
					if($field=="")
					{
						$field="`".$key."`";
						$vals="'".$meminfo[$key]."'";
					}
					else
					{
						$field=$field.",`".$key."`";
						$vals=$vals.",'".$meminfo[$key]."'";
					}
				}

				$sSQL = "INSERT INTO ".$tblname." ($field) values ($vals)";
				$wpdb->query($sSQL);
				return true;
			}
			else
			{
				return false;
			}
		}

		function updMember($tblname,$meminfo)
		{
			global $wpdb;
			$count = sizeof($meminfo);
			if($count>0)
			{
				$field="";
				$vals="";
				foreach($this->myFields as $key)
				{
					if($field=="" && $key!="id")
					{
						$field="`".$key."` = '".$meminfo[$key]."'";
					}
					else if($key!="id")
					{
						$field=$field.",`".$key."` = '".$meminfo[$key]."'";
					}
				}

				$sSQL = "update ".$tblname." set $field where id=".$meminfo["id"];
				$wpdb->query($sSQL);
				return true;
			}
			else
			{
				return false;
			}
		}
	}


?>