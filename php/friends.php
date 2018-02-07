<?php
session_start();
if(!isset($_SESSION['mainuid']))
{
    echo('returntoindex');
    return;
}
include 'dbconnection.php';
$mid=$_SESSION['mainuid'];
$uid1 = $_SESSION['uid'];
$friend = "friend";
	$sql = "SELECT userid,CONCAT(fname,' ',lname),nickname,profilepictureURL,hometown
            		FROM users
            		WHERE userid in (SELECT userid2
            		FROM users as u
            		INNER JOIN friend as f on f.userid1 = u.userid
            		WHERE u.userid = "."'$uid1'"." AND f.status = "."'$friend'"."
                    UNION
                    SELECT userid1
            		FROM users as u
            		INNER JOIN friend as f on f.userid2 = u.userid
            		WHERE u.userid = "."'$uid1'"." AND f.status = "."'$friend'".")";
$result = $connection->query($sql);

	 $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
          $rows['user'][] = $r;
        }


 echo json_encode($rows);
?>