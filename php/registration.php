<?php
include 'dbconnection.php';
$fname = $_POST['fn'];
$lname = $_POST['ln'];
$nname = $_POST['nn'];
$gender = $_POST['gender'];
$em = $_POST['email'];
$pass = $_POST['password'];
$pass = md5($pass);
$dob = $_POST['dob'];
$pieces = explode("/", $dob);
$pp='../img/male.png';
if($gender==0){
$pp='../img/female.png';}
$d = date('Y-m-d',mktime(0,0,0,$pieces[0],$pieces[1],$pieces[2]));
	$sql = "SELECT * FROM `users` WHERE email = "."'$em'";
	$result = $connection->query($sql);
    if ($result->num_rows>0)
     {

        echo ("username found");
		die(); 
     }
     else
     {
		$sql = "INSERT INTO `users`(`fname`, `lname`, `nickname`, `pass`, `email`, `gender`, `birthDate`,`profilepictureURL`) VALUES ('$fname','$lname','$nname','$pass','$em',$gender,'$d','$pp')";
		$result = $connection->query($sql);
		  $querys = "SELECT * FROM `users` WHERE `email` = '$em'";
            $result = $connection->query($querys);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['mainuid'] = $row['userid'];
		echo ("gohome");
	}

$connection->close();
?>