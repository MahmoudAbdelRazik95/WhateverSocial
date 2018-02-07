<?php 
include 'dbconnection.php';
session_start();
$em = $_POST['email'];
$pass = $_POST['password'];
$hashed = md5($pass);

	$sql = "SELECT * FROM `users` WHERE email = "."'$em'". "AND pass = "."'$hashed'";
	$result = $connection->query($sql);
	if ($result->num_rows<=0)
     {

        echo "username not found";
     }
     else
     {
        $row = mysqli_fetch_assoc($result);
         $_SESSION['mainuid'] = $row['userid'];
     	echo "gohome";
     }

?>