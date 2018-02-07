<?php
session_start();
if(!isset($_SESSION['mainuid']))
{
    echo('returntoindex');
    return;
}

include 'dbconnection.php';
$search=$_SESSION['lastSearch'];
	$sql = "SELECT fname,lname,userid,profilepictureURL,hometown FROM `users` WHERE email like '"."$search". "%' OR hometown like '"."$search"."%' OR fname like '"."$search"."%' OR lname like '"."$search"."%' OR CONCAT(fname,' ',lname) like '"."$search"."%' OR CONCAT(fname,lname) like '"."$search"."%'";
$result = $connection->query($sql);

	 $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
          $rows['user'][] = $r;
        }
		$sqls = "SELECT * FROM `post` WHERE caption like '"."$search". "%'";
$result = $connection->query($sqls);

    	$posts = array();
                while($r = mysqli_fetch_assoc($result)) {
                  $posts['post'][] = $r;
                }


 echo json_encode(array("posts" => $posts, "users" => $rows));
?>