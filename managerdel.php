<?php
	include("init.php");
	include("session.php");
	
	$managerid = $_GET['managerid'];
	if( $managerid != ''){
		$sql = "delete from managers where id='$managerid'";
		mysql_query($sql,$dbcon);
	}
	header ("location:managers.php?success=delete");
	exit();
?>
