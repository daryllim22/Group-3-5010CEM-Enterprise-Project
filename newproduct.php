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


<div class="layout">
<h1>Add Product</h1>
	<form action="#" method="post" >
		<p>Product Name:</p>
		<input type="text" name="pname" placeholder="Name">
		<p>Price:</p>
		<input type="text" name="price" placeholder="RM0.00">
		<p> Product Description:</p>
		<textarea name="pd-discription" placeholder="Product Description"></textarea>
		<p>Image:</p>
		<input type="file" name="pd-image" id="files">
		<button type="submit">Add Product</button>
	</form>
</div>


</body>
</html>