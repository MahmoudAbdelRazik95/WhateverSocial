<?php
include 'dbconnection.php';
session_start();
$userid=$_SESSION['mainuid']

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$nickname=$_POST['nickname'];
$Email=$_POST['email'];
$hometown=$_POST['hometown'];
$Marstatus=$_POST['maritalstatus'];
$pp=$_POST['pp'];
$bio=$_POST['bio'];

if (isset($_POST['fname']) && !empty($_POST['fname']))
{
	echo "yup";
	echo ".$fname";
	echo ".$userid";
	$sql="UPDATE users set fname = "."'$fname' WHERE userid= "."'$userid'";
	$result= mysql_query($sql,$con);
}


if (isset($_POST['lname']) && !empty($_POST['lname']))
{
	$sql="UPDATE users set lname = "."'$lname' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}

if (isset($_POST['nickname']) && !empty($_POST['nickname']))
{
	$sql="UPDATE users set nickname = "."'$nickname' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}

if (isset($_POST['email']) && !empty($_POST['email']))
{
	$sql="UPDATE users set email = "."'$Email' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}
if (isset($_POST['hometown']) && !empty($_POST['hometown']))
{
	$sql="UPDATE users set hometown = "."'$hometown' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}
if (isset($_POST['maritalstatus']) && !empty($_POST['maritalstatus']))
{
	$sql="UPDATE users set maritalstatus = "."'$Marstatus' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}

}
if (isset($_POST['bio']) && !empty($_POST['bio']))
{
	$sql="UPDATE users set bio = "."'$bio' WHERE userid= "."'$userid'";
	 mysql_query($sql,$con);
}















?>