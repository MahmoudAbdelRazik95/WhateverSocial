<?php
session_start();
include 'dbconnection.php';
$mid =  $_SESSION['mainuid'];
$postid= $_POST['postid'];
	$sql = "INSERT INTO `likes`(`userid`, `postid`) VALUES ('$mid','$postid')";
                                       	$result = $connection->query($sql);
$sql = "SELECT * FROM `post` WHERE `postid` = '$postid'";
 	$result = $connection->query($sql);
 $row = mysqli_fetch_assoc($result);
         $user = $row['userid'];
$sql = "SELECT * FROM `users` WHERE `userid` = '$mid'";
 	$result = $connection->query($sql);
 $row = mysqli_fetch_assoc($result);
         $liker = $row['nickname'];
$content = $liker.' has liked your post';
$status = 0;
$type = 'like';
$userid = $user;
         $sql="INSERT INTO `notification`( `content`, `status`, `type`, `userid`) VALUES ('$content',$status,'$type','$userid')";
         	$result = $connection->query($sql);


?>