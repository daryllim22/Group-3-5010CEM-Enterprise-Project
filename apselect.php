<?php
	require("session_handling.php");
?>


<!DOCTYPE html>
<html lang="utf=8">



<head>
<title>Admin Product</title>
<link rel="stylesheet" href="astyle.css">
</head>
<body>

<div class="sidebar">
	<img src ="images/logo.png" width="160" height="100">
		<img src="images/profile.png" class="profile">
			<a href="admin.html">Dashboard</a>
			<a href="pselect.html">Product</a>
			<a href="auser.php">Users</a>
			<a href="index.php">Statistic</a>
			<a href="index.php">Logout</a>
</div>

<div class="select">
		<a href="newproduct.php"><img src ="images/add.png" width="300" height="300"></a>
		<a href="viewproducts.php"><img src ="images/delete.png" width="300" height="300"></a>
	</div>
</div>

</body>
</html>