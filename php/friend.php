<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function idclicked(clicked_id)
		{
			c = clicked_id;
			document.forms[0].cid.value = c;

			document.getElementById('formtosubmit').submit();
		}
	</script>
	<style>
		body {
			background-color: #5256ad;
			color: LightSkyBlue;
			text-align: center;
			font-size: 35px;
		}
		.hyperlinks {
			font-size: 30px;
			color: white;
		}
		.hyperlinks:hover {
			color: #1daf88;
		}
		.friends {
			border-bottom: 2px double black;
			border-width: 10px;
		}
	</style>
</head>
<body>
<form  id="formtosubmit" action="profiles-1.php" method="POST" style="display:none;">
	<input type="hidden" name="cid" id="cid" value="">	
</form>
<h1 class="friends">Friends</h1>
<?php
include 'dbconnection.php';
session_start();

$sql = "SELECT userid,CONCAT(fname,' ',lname),nickname
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
if ($result->num_rows<=0)
     {
	    echo "You have no friends yet!";
		die(); 
     }
else
	{
		while ($row = $result->fetch_assoc())
		{
			$friend = $row["CONCAT(fname,' ',lname)"];
			$id = $row["userid"];
			?>
			<a class = "hyperlinks" id="<?php echo htmlspecialchars($id); ?>" href = "#" onclick="idclicked(this.id)" > <?php echo "$friend<br>"; ?></a>
			<?php
		}
	}
?>
</body>
</html>

