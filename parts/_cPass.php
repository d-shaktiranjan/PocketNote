<?php

include 'dbconnect.php';
session_start();
$mail=$_SESSION['mail'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $oldPass=$_POST["oldPass"];
    $newPass=$_POST['newPass'];
    $newCPass=$_POST['newCPass'];
    $sql="SELECT * FROM wn_userdata where mail='$mail'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);

    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($oldPass,$row['pass'])){
                if($newCPass==$newPass){
                    $newPass=password_hash($newPass,PASSWORD_DEFAULT);
                    $sql="UPDATE `wn_userdata` SET `pass` = '$newPass' WHERE `wn_userdata`.`mail` = '$mail'";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo "Done";
                    }
                }
            }
        }
    }
}


header('location: /web_note/index.php');

?>