<?php
	include("init.php");
	include("session.php");
	
	$page = mysql_real_escape_string($_GET['page']);
	$screenid = mysql_real_escape_string($_GET['screenid']);

	if( $screenid != ''){
		$sql = "delete from screens where id='$screenid'";
		mysql_query($sql,$dbcon);
		header ("location:screens.php?success=delete&page=" . $page);
		exit();
	}
	else{
		header ("location:screens.php?page=" . $page);
		exit();
		
	}
?>
