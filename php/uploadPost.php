<?php
include 'dbconnection.php';
session_start();
$mid = $_SESSION['mainuid'];
$sql = "SELECT * FROM `users` WHERE userid = "."$mid";
$result = $connection->query($sql);
$postdate = date("Y-m-d h:i:sa");
if ($row = $result->fetch_assoc()){
$postername = $row["nickname"];
}
$target_dir = "../img/";
$content = $_POST["post"];
$privacy = $_POST["myradiogroup"];
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

if($target_dir==$target_file){
$postdate = date("Y-m-d h:i:sa");
		$imageurl = "";
		if($privacy=='public')
		{$ispublic=1;
		}
		else
		{$ispublic=0;
		}
		$sql = "INSERT INTO `post`(`postername`, `caption`, `posttime`, `ispublic`, `userid`) VALUES ('$postername','$content','$postdate',$ispublic,'$mid')";
		$result = $connection->query($sql);
        $last_id = $connection->insert_id;
header( 'Location: ../home' );
return;
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
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
		$sql = "INSERT INTO `post`(`postername`, `caption`, `posttime`, `ispublic`, `userid`) VALUES ('$postername','$content','$postdate',$ispublic,'$mid')";
		$result = $connection->query($sql);
        $last_id = $connection->insert_id;
        $imageurl='../img/post_'.$last_id.'.'.$imageFileType;




    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageurl)) {

        $sql = "UPDATE `post` SET `imageurl` = '$imageurl' WHERE postid = '$last_id'";
		$result = $connection->query($sql);
header( 'Location: ../home' );
exit();

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>