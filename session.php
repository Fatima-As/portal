<?php
	session_start();
	if($_SESSION['AdminID'] == '' || $_SESSION['AdminUserName'] == '' || $_SESSION['AdminUserLoGGeD'] != 'Yes' ){

//		  User not logged in.
		header("location:login.php");
		exit();
	}
	
?>