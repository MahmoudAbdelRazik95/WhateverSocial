<?php
session_start();
include 'dbconnection.php';
$mid =  $_SESSION['mainuid'];
$postid= $_POST['postid'];

	$sql = "SELECT * FROM  `likes` WHERE `likes`.`userid` = '$mid' AND `likes`.`postid` = '$postid'";
	$result = $connection->query($sql);
	if ($result->num_rows<=0)
             {
             echo "notliked";
             }
             else
             {
             echo "liked";
             }
?>