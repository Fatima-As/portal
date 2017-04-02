<?php

try {
    
    $dbcon = new PDO ("mysql:host=localhost;dbname=dbvideowalls","root","");
    echo "Connected";
    if(isset($_POST['signup'])){
        $name=$_POST['username'];
        $password=$_POST['password'];
        $fullname=$_POST['first_name'];
        $email=$_POST['email'];
    $insert=$dbcon->prepare("INSERT INTO managers (username, password, fullname,email) values (:username,:password,:first_name,:email)");
    /*$insert->bindParam(':', $name);
    $insert->bindParam(':', $password);
    $insert->bindParam(':', $fullname);
    $insert->bindParam(':', $email);*/
    $insert->execute(array(':username'=>$name,':password'=>$password,':first_name'=>$fullname,':email'=>$email));
    }
} catch (PDOException $e) {
echo "error".$e->getMEssage();
}
?>

<h1>Registration</h1>
<form name="registration"  method="POST">
  <label for="username">Username: </label>
  <input type="text" name="username"/>
  <label for="password">Password: </label>
  <input type="password" name="password"/>
  <label for="first_name">First name: </label>
  <input type="text" name="first_name"/>
  
  <label for="email">Email: </label>
  <input type="text" name="email"/>
  <br/>
  <button type="submit" name="signup">Submit</button>
 </form>

