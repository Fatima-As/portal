<?php
	//include("init.php");
        include ("dbinc.php");

        session_start(); 
	//if($_POST['cmd'] == 'posted'){
    //  if (isset($_POST['submit'])){
		$txtusername = $_POST['txtusername'];
		$txtpassword = $_POST['txtpassword'];
		if($txtusername == ''){
			header("location:login.php?err=1");
			exit();
		}
		elseif($txtpassword == ''){
			header("location:login.php?err=2");
			exit();
		}
		else {
			$sql = "select id, fullname from managers where username = '$txtusername' and password = md5(md5(md5('$txtpassword')))and enabled='Yes'";
                        
			$myrs = mysqli_query($dbcon,$sql);
			if($row = mysqli_fetch_array($myrs)){
				$_SESSION['AdminID'] = $row['id'];
				$_SESSION['AdminUserLoGGeD'] = 'Yes';
				$_SESSION['AdminUserName'] = $txtusername;
				$_SESSION['AdminFullName'] = $row['fullname'];
				
                                header("location:index.php");
				exit(); 
			}
			else {
				header("location:login.php?err=3");
				exit();
			} 
		}
	//}
?>
