<?php
session_start();
include 'dbconnection.php';
$mid =  $_SESSION['mainuid'];
$postid= $_POST['noti'];
	$sql = "UPDATE `notification` SET `status`=1 WHERE `notificationid`='$postid'";
	$result = $connection->query($sql);
?>