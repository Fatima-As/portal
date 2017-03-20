<?php
/*	define( 'DB_USER', 'root' );
	define( 'DB_NAME', 'dbvideowalls' );
	define( 'DB_HOST', 'localhost' );
	define( 'DB_PASS', '' );

	define( 'DB_TYPE', 'mysql' );
	
	//$dbcon=mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_errno() . ": " . mysql_error() . "\n");
	//mysql_select_db(DB_NAME,$dbcon) or die(mysql_errno() . ": " . mysql_error() . "\n");
	
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
} 
*/
$DB_USER='root';
$DB_HOST='localhost';
$DB_PASS='';
$DB_NAME='dbvideowalls';
$DBTYPE='mysql';
  $dbcon= new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die(mysqli_errno() . ": " . mysqli_error() . "\n");
//mysqli_select_db($DB_NAME, $dbcon) or die(mysqli_errno() . ": " . mysqli_error() . "\n");
  $db_select = mysqli_select_db($dbcon, $DB_NAME);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}
  echo 'Success';
?>
