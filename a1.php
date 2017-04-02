<?php

include 'dbinc.php';

if(isset($_POST["signup"]))
{
 
$name = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
 
$name = mysqli_real_escape_string($dbcon, $name);
$email = mysqli_real_escape_string($dbcon, $email);
$password = mysqli_real_escape_string($dbcon, $password);
$password = md5($password);


$query = mysqli_query($dbcon, "INSERT INTO managers (username, password, email)VALUES ('$name', '$password', '$email')");

if($query)
{
	echo "Thank You! you are now registered.";
}}
?>



<h1>Registration</h1>
<form name="registration"  method="POST">
  <label for="username">Username: </label>
  <input type="text" name="username"/>
  <label for="password">Password: </label>
  <input type="password" name="password"/>
  <label for="email">Email: </label>
  <input type="text" name="email"/>
  <br/>
  <button type="submit" name="signup">Submit</button>
 </form>