<?php
include 'dbconnection.php';
session_start();
$userid=$_SESSION['mainuid'];
$time = time();

$mid = $_SESSION['mainuid'];
$sql = "SELECT * FROM `users` WHERE userid = "."$mid";
$result = $connection->query($sql);
$postdate = date("Y-m-d h:i:sa");
if ($row = $result->fetch_assoc()){
$postername = $row["nickname"];
}
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
		$imageurl = "";
		if($privacy=='public')
		{$ispublic=1;
		}
		else
		{$ispublic=0;
		}

        $imageurl='../img/post_'.$userid.'_'.$time.'.'.$imageFileType;




    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageurl)) {

        $sql = "UPDATE `users` SET `profilepictureURL` = '$imageurl' WHERE userid = '$userid'";
		$result = $connection->query($sql);
header( 'Location: ../home' );
exit();

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>