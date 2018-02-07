<?php
include 'dbconnection.php';
session_start();
$userid=$_SESSION['mainuid']

$sql= "SELECT * FROM users WHERE userid= "."'$userid' AND pass="."'$strold'";
$result= mysql_query($sql,$con);
if(mysql_num_rows($result) > 0)
{
	$sql2="UPDATE users set pass = "."'$strnew' WHERE userid= "."'$userid'";
	mysql_query($sql2,$con);
	
	
}


?>