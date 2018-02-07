<?php
session_start();
include 'dbconnection.php';
$mid =  $_SESSION['mainuid'];
$postid= $_POST['postid'];

	$sql = "SELECT * FROM  `users` WHERE `users`.`userid` = '$postid'";
	$result = $connection->query($sql);
	 $row = mysqli_fetch_assoc($result);
             $url = $row['profilepictureURL'];
echo($url);
?>