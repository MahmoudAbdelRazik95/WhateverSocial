<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style>
	body {
			background-color: #5256ad;
			color: LightSkyBlue;
			text-align: center;
			font-size: 35px;
		}
		.name {
			font-size: 30px;
			color: white;
		}
		.friends {
			border-bottom: 2px double black;
			border-width: 10px;
		}
</style>
<body>
<h2 class="friends">Friend Request</h2>
<?php
include 'dbconnection.php';
session_start();
$uid = $_SESSION['uid'];
$mid = $_SESSION['mainuid'];
$pending = "pending";
$friend = "friend";
$sql = "SELECT fname,lname,userid FROM users as u
INNER JOIN friend as f on f.userid1 = u.userid
WHERE f.status = "."'$pending'"." AND f.userid2 = "."'$mid'";
$result = $connection->query($sql);
if ($result->num_rows<=0)
    {
	   echo "You have no friend request!";
	   die(); 
    }
else
{
	while ($row = $result->fetch_assoc())
	{
		$id = $row["userid"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$name = $fname." ".$lname;
		$button1name = "buttona".$id;
		$button2name = "buttoni".$id;
		?>
		<h2 class="name"><?php echo htmlspecialchars($name);?></h2>
		<form method="POST" action="">
			<input type="submit" name="<?php echo htmlspecialchars($button1name); ?>" value="Accept">
			<input type="submit" name="<?php echo htmlspecialchars($button2name); ?>" value="Ignore">
		</form>
		<?php
	}
	$i2=1;
	    while ($i2<=$id) {
	    	$newbutton1 = "buttona".$i2;
	    	$newbutton2 = "buttoni".$i2;
	      if (isset($_POST[$newbutton1]))
	        {
	    	 	$sql = "UPDATE `friend` SET `status`= "."'$friend'"." WHERE userid2 = "."'$mid'"." AND userid1 = "."'$i2'"; 
	    	 	$result = $connection->query($sql);
	    	 	unset($_POST['newbutton1']);
	    	 	header("Location: requests.php");
	        }
	        elseif (isset($_POST[$newbutton2])) {
	        	$sql = "DELETE FROM `friend` WHERE userid1 = "."'$i2'"." and userid2 = "."'$mid'"; 
	    	 	$result = $connection->query($sql);
	    	 	unset($_POST['newbutton2']);
	    	 	header("Location: requests.php");
	        }
	        $i2 = $i2 + 1;
	    }

}
?>
</body>
</html>