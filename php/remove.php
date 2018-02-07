<?php
include 'dbconnection.php';
session_start();
$userid=$_SESSION['mainuid'];
$sql= "SELECT * FROM `users` WHERE `userid`='$userid'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$gender = $row["gender"];
$defaulturl="../img/male.png";
if($gender==0){
$defaulturl="../img/female.png";
}



$sql= "Update users set profilepictureURL="."'$defaulturl' WHERE userid= "."'$userid'";

$result = $connection->query($sql);
header( 'Location: ../home' );




?>