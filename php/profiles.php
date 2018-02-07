<?php
include 'dbconnection.php';
session_start();
$uid = $_SESSION['uid'];
$mid = $_SESSION['mainuid'];
if (isset($_POST['cid'])) {
	$uid = $_POST['cid'];
	$_SESSION['uid'] = $uid;
}
$sql = "SELECT * FROM `users` WHERE userid = "."$uid";
$result = $connection->query($sql);
$ppurl = "module_table_bottom";
$em="";
$fname="";
$lnam="";
$gender=0;
$genders="Female";
if ($row = $result->fetch_assoc())
	{
		$em = $row["email"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$nname = $row["nickname"];
		$gender = $row["gender"];
		$dob = $row["birthDate"];
		$hometown = $row["hometown"];
		$mstatus = $row["maritalstatus"];
		$bio = $row["bio"];
		$ppurl = $row["profilepictureURL"];	
		if ($gender == 1)
		{
			$genders = "Male";
		}
		else
		{
			$genders = "Female";
		}
	}
?>
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
			color: white;
		}
	div.image {

	}
	.submitbtn{
		width: 250px;
		height: 30px;
		box-sizing: border-box;
		border: 3px solid MidnightBlue;
		background-color: #1daf88;
	}
	.submitbtn:hover{
		font-weight: bold;
		cursor: pointer;
	}
	.links{
		color: #1daf88;
	}
	.links:hover{
		font-weight: bold;
		cursor: pointer;
	}
</style>
<body>
<div class="image">
<?php echo "<img src='" . $ppurl . "' alt='error' width='250px' height='250px'>"?>
</div>
<h1><?php echo "$fname $lname"; ?></h1>
<h4><?php echo "Nickname: $nname"."<br>"."Email: $em"."<br>"."Gender: $genders"."<br>"."Marital Status: $mstatus"."<br>"."Hometown: $hometown"; ?></h4>
<?php
if($uid==$mid) //dah el user beyefta7 el prfile beta3o
{
	?>
	<h4><?php echo "Date Of Birth: $dob"."<br>"."Bio:<br>$bio" ?></h4>
	<form method="POST" action="../EditProfile.html">
		<input class="submitbtn" type="submit" name="editprofile" value="Edit Profile"><br><br>
		<a class = "links" href="../friends/">Friends</a><br><br>
	</form>
	<form action="requests.php" method="POST">
		<input class="submitbtn" type="submit" name="requests" value="Requests">
	</form>
	<?php
	
	if (isset($_POST['submit'])) 
	{
		unset($_POST['submit']);
		$post = $_POST['post'];
		$postdate = date("Y-m-d h:i:sa");
		$imageurl = "";
		$ispublic = $_POST['ispublic'];
		$sql = "INSERT INTO `post`(`postername`, `caption`, `posttime`, `imageurl`, `ispublic`, `userid`) VALUES ('$nname','$post','$postdate','imageurl',$ispublic,'$mid')";
		$result = $connection->query($sql);
	}
	$sql = "SELECT * FROM `post` WHERE userid = "."'$uid' ORDER BY posttime DESC";
	$result = $connection->query($sql);
	if ($result->num_rows<=0)
     {
	    echo "You have no posts yet!";
		die(); 
     }
	else
	{
		while ($row = $result->fetch_assoc())
		{
			$caption = $row["caption"];
			$postername = $row["postername"];
			$posttime = $row["posttime"];
			$numberoflikes = $row["numberoflikes"];
			$imageurl = $row["imageurl"];
			$public = $row["ispublic"];
			echo "-------------------------"."<br>";
			echo "$postername"."<br>"."$caption"."<br>"."$posttime"."<br>"."<br>";
		}
	}
}
else
{
	$sql = "SELECT status FROM `friend` WHERE userid1 = "."'$mid'"." AND userid2 = "."'$uid' OR userid1 = "."'$uid'"." AND userid2 = "."'$mid'";
	$result = $connection->query($sql);
	if ($row = $result->fetch_assoc()) // yeb2a ya friend ya pending
	{
		$status = $row["status"];
		if ($status == "friend") 
		{
			?><h4><?php echo "Date Of Birth: $dob"."<br>"."Bio:<br>$bio" ?></h4>
			<form method="POST" action="">
				<input type="submit" name="removefriend" value="Remove Friend">
			</form>
			<a class="links" href="../friends/">Friends</a><br><br>
			<?php
			if (isset($_POST['removefriend'])) {
				$sql = "DELETE FROM `friend` WHERE (userid1='$mid' and userid2='$uid' and status='friend') OR  (userid1='$uid' and userid2='$mid' and status='friend')";
				$result = $connection->query($sql);
				header("Location: profiles.php");
			}
			$sql = "SELECT * FROM `post` WHERE userid = "."'$uid' ORDER BY posttime DESC";
			$result = $connection->query($sql);
			if ($result->num_rows<=0)
   		    {
	    		echo "Friend has no posts yet!";
				die(); 
     		}
			else
			{
				while ($row = $result->fetch_assoc())
				{
					$caption = $row["caption"];
					$postername = $row["postername"];
					$posttime = $row["posttime"];
					$numberoflikes = $row["numberoflikes"];
					$imageurl = $row["imageurl"];
					$public = $row["ispublic"];
					echo "-------------------------"."<br>";
					echo "$postername"."<br>"."$caption"."<br>"."Likes: $numberoflikes"."<br>"."$posttime"."<br>"."<br>";
				}
			}	
		}
		else
		{
			?> <form method="POST" action="">
				<input type="submit" name="pending" value="Pending">
			</form>
			<?php
			if (isset($_POST['pending'])) {
				$sql = "DELETE FROM `friend` WHERE userid1 = "."'$mid'"." and userid2 = "."'$uid'";
				$result = $connection->query($sql);
				header("Location: profiles.php");
			}
			$sql = "SELECT * FROM `post` WHERE userid = "."'$uid'"." AND ispublic = true ORDER BY posttime DESC";
			$result = $connection->query($sql);
			if ($result->num_rows<=0)
   		    {
	    		echo "User has no posts yet!";
				die(); 
     		}
			else
			{
				while ($row = $result->fetch_assoc())
				{
					$caption = $row["caption"];
					$postername = $row["postername"];
					$posttime = $row["posttime"];
					$numberoflikes = $row["numberoflikes"];
					$imageurl = $row["imageurl"];
					$public = $row["ispublic"];
					echo "-------------------------"."<br>";
					echo "$postername"."<br>"."$caption"."<br>"."Likes: $numberoflikes"."<br>"."$posttime"."<br>"."<br>";
				}
			}
		}
	}
	else // yeb2a dah msh friend
	{
		$sql = "SELECT * FROM `friend` WHERE userid2 ="."'$mid'"."AND userid1 = "."'$uid'";
		$result = $connection->query($sql);
		if ($result->num_rows>0)
   		    {
   		    	?>
   		    	<h2><?php echo htmlspecialchars($nname)?> sent you a friend request!</h2>	
   		    	<?php
   		    	$sql = "SELECT * FROM `post` WHERE userid = "."'$uid'"." AND ispublic = true ORDER BY posttime DESC";
			$result = $connection->query($sql);
			if ($result->num_rows<=0)
   		    {
	    		echo "User has no posts yet!";
				die(); 
     		}
			else
			{
				while ($row = $result->fetch_assoc())
				{
					$caption = $row["caption"];
					$postername = $row["postername"];
					$posttime = $row["posttime"];
					$numberoflikes = $row["numberoflikes"];
					$imageurl = $row["imageurl"];
					$public = $row["ispublic"];
					echo "-------------------------"."<br>";
					echo "$postername"."<br>"."$caption"."<br>"."Likes: $numberoflikes"."<br>"."$posttime"."<br>"."<br>";
				}
			}
   		    }
   		    else{
		?> <form method="POST" action="profiles.php">
				<input type="submit" name="add" value="Add friend">
			</form>
			<?php
			if (isset($_POST['add'])) {
				$type = "friend";
				$status = 0;
				$sql = "INSERT INTO `friend`(`userid1`, `userid2`, `status`) VALUES ($mid,$uid,'pending')";
				$result = $connection->query($sql);
				$sql = "Select nickname from users where userid = "."$mid";
				$result = $connection->query($sql);
				if ($result->num_rows>0)
   		    		{
   		    			while ($row = $result->fetch_assoc())
						{
							$nname2 = $row['nickname'];
						}
   		    		}
   		    		$content = "$nname2 added you as a friend";
					$sql = "INSERT INTO `notification`(`content`, `status`, `type`, `userid`) VALUES ('$content',$status,'$type','$uid')";
					$result = $connection->query($sql);
					header("Location: profiles.php");
				}
			$sql = "SELECT * FROM `post` WHERE userid = "."'$uid'"." AND ispublic = true ORDER BY posttime DESC";
			$result = $connection->query($sql);
			if ($result->num_rows<=0)
   		    {
	    		echo "User has no posts yet!";
				die(); 
     		}
			else
			{
				while ($row = $result->fetch_assoc())
				{
					$caption = $row["caption"];
					$postername = $row["postername"];
					$posttime = $row["posttime"];
					$numberoflikes = $row["numberoflikes"];
					$imageurl = $row["imageurl"];
					$public = $row["ispublic"];
					echo "-------------------------"."<br>";
					echo "$postername"."<br>"."$caption"."<br>"."Likes: $numberoflikes"."<br>"."$posttime"."<br>"."<br>";
				}
			}
	}}
}
?>
</body>
</html>