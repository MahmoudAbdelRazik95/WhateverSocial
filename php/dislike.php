<?php
session_start();
include 'dbconnection.php';
$mid =  $_SESSION['mainuid'];
$postid= $_POST['postid'];
	$sql = "DELETE FROM `likes` WHERE `likes`.`userid` = '$mid' AND `likes`.`postid` = '$postid'";
	$result = $connection->query($sql);
?>