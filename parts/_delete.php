<?php

include 'dbconnect.php';
$id=$_GET['note_id'];
session_start();
$mail=$_SESSION['mail'];
$ar=explode("@",$mail);
$name=$ar[0];
echo $name;

$sql="DELETE FROM `$name` WHERE `$name`.`sno` = $id";
$result=mysqli_query($conn,$sql);

header('location: /web_note/index.php');

?>