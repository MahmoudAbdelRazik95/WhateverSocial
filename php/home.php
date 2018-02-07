<?php
include 'dbconnection.php';
session_start();
if(!isset($_SESSION['mainuid']))
{
    echo('returntoindex');
    return;
}
$mid = $_SESSION['mainuid'];
	$sql = "SELECT p.userid, p.caption, p.posttime,p.postid,p.postername,p.imageurl
            FROM post p
            WHERE ispublic=1 OR p.userid=  '$mid'
            UNION SELECT DISTINCT p.userid, p.caption, p.posttime,p.postid,p.postername,p.imageurl
            FROM post p
            INNER JOIN friend f ON p.userid=f.userid2 OR p.userid=f.userid1
            INNER JOIN users u ON f.userid1= '$mid' OR f.userid2= '$mid'
            WHERE p.ispublic=0 ORDER BY posttime DESC";

$result = $connection->query($sql);
  $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
      $rows['user'][] = $r;
    }
$sql="SELECT `profilepictureURL` from `users` WHERE userid =".$mid;
$result = $connection->query($sql);
$row = $result->fetch_assoc();


$sql="SELECT COUNT(userid) as count FROM notification WHERE userid=".$mid." AND `status`=0";
$result = $connection->query($sql);
$rowsa = $result->fetch_assoc();
$count = $rowsa["count"];
  echo json_encode(array("posts" => $rows, "pp" => $row["profilepictureURL"],"noti"=>$count));

$connection->close();
?>