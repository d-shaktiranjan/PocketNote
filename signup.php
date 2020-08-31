<?php

session_start();
if(isset($_SESSION['mail'])){
  header("location: index.php");
}

$inserted=false;
$passNotMatch=false;
$mail=null;
$alreadyhere=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'parts/dbconnect.php';
  $mail=$_POST["mail"];
  $password=$_POST["pass"];
  $cpassword=$_POST["cpass"];
  $lname=$_POST["lname"];
  $fname=$_POST["fname"];

  $checkmail="SELECT * FROM `wn_userdata` WHERE mail='$mail'";
  $result=mysqli_query($conn,$checkmail);
  $norow=mysqli_num_rows($result);
  $alreadyhere=false;
  if($norow>0){
    $alreadyhere=true;
  }

  if(($password==$cpassword) && $alreadyhere==false){
    $hash_pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `wn_userdata` (`mail`, `pass`, `fname`, `lname`)
     VALUES ('$mail', '$hash_pass', '$fname', '$lname')";

    $result=mysqli_query($conn,$sql);
    if($result){
      $inserted=true;
    }
  }

  if($password!=$cpassword){
    $passNotMatch=true;
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Signup Page</title>
  </head>
  <body>
  <?php include "parts/navbar.php"?>
  <?php

  if($inserted){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Account Created!</strong> Now you can login.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  if($passNotMatch){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Password & confirm password not matched.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if($alreadyhere){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sorry!</strong> Email id already taken. Try a different one.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  ?>
  <div class="container">
  <form action="signup.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="pass" name="pass" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="cpass" name="cpass" required>
  </div>
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
  </div>

  <hr>
  <div class="container" id="signupbtn">
  <button type="button" class="btn btn-outline-success"
   onclick="document.location='login.php'">Already Have An Account</button>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$ar=explode("@",$mail);
$name=$ar[0];
if($inserted){
  $sql="CREATE TABLE `web_note`.`$name` ( `sno` INT(255) NOT NULL AUTO_INCREMENT ,  `title` VARCHAR(30) NOT NULL ,  `note` TEXT NOT NULL ,  `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`sno`)) ENGINE = InnoDB";
  mysqli_query($conn,$sql);
}

?>