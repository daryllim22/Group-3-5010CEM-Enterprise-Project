<?php

require("session_handling.php");

?>

<!DOCTYPE html>
<html lang="utf=8">



<head>
<title>Admin Users</title>
<link rel="stylesheet" href="astyle.css">
</head>
<body>

<div class="sidebar">
	<img src ="images/logo.png" width="160" height="100">
		<img src="images/profile.png" class="profile">
			<a href="admin.html">Dashboard</a>
			<a href="apselect.php">Product</a>
			<a href="auser.php">Users</a>
			<a href="index.php">Statistic</a>
			<a href="logout.php">Logout</a>
</div>

<table>
	<tr>
		<th>Username</th>
		<th>Email</th>
		<th></th>
	</tr>
	
<?php
include("Connectdb.php");

if (isset($_GET['id'])){
$id=$_GET['id'];	
$delete= mysqli_query($con, "DELETE from db where id= '$id'");
	
}
	
$query = "SELECT id, name, email from db ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)){
	echo "<tr><td>". $row["name"] . "</td><td>" . $row["email"] . "<td>" . "<div class='delete'>" . "<a href='./auser.php?id=".$row['id']."' class='delete'>Delete</a>" . "</div>" . "</td></tr>";

	}
	echo"</table>";
}
else {
	
echo"0 result";		
}

$con-> close();
?>
 </table>
<br/><br/>
</body>
</html>