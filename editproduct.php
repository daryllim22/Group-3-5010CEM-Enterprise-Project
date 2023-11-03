<?php

    require("session_handling.php");
    include("Connectdb.php");
    
    //retrieving user ID from the URL
    $pdID = $_GET['id'];

    //pulling the current product's data from the database
    $query = "SELECT pdName, pdPrice, pdSize, pdStockCount, pdDescription, pdImage FROM product WHERE pdID = $pdID";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('SQL query error: ' . mysqli_error($con));
    }

        
    //retrieving the row of data
    $tbrow = mysqli_fetch_assoc($result);

    //error message if product not found in the database
    if (!$tbrow) {
        error_log("SQL query error: " . mysqli_error($con));
        die("Product not found.");
    }

    $pdImg = $tbrow['pdImage'];
    $pdName = $tbrow['pdName'];
    $pdPrice = $tbrow['pdPrice'];
    $pdSize = $tbrow['pdSize'];
    $pdStockCount = $tbrow['pdStockCount'];
    $pdDescription = $tbrow['pdDescription'];
?>


<!DOCTYPE html>
<html lang="utf=8">



<head>
<title>Admin Edit Product</title>
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
			<a href="index.php">Logout</a>
</div>

<div class="layout">
<h1>Add Product</h1>
    <!-- form sends over to `db_editproduct.php -->
	<form action="db_editproduct.php?id=<?php echo $pdID; ?>" method="post" enctype="multipart/form-data">
		<p>Product name:</p>
		<input type="text" name="pd-name" value="<?php echo $pdName; ?>" autocomplete="off" required>
		<p>Price:</p>
		<input type="text" name="pd-price" value="<?php echo $pdPrice; ?>" autocomplete="off" required>
        <div class="row">
            <div>
                <p>Product Size</p>
                <input type="text" name="pd-size" value="<?php echo $pdSize; ?>" autocomplete="off" required style="width: 50%;">
            </div>
            <div>
                <p>Quantity</p>
                <input type="text" name="pd-stock-count" value="<?php echo $pdStockCount; ?>" autocomplete="off" required style="width: 50%;">
            </div>
        </div>
		<p>Product Description:</p>
		<textarea name="pd-description"><?php echo $pdDescription; ?></textarea>
		<p>Image:</p>
        <p>Current File - <?php echo $pdImg; ?></p>
		<input type="file" name="pd-image" id="files">
		<label for="files">Choose Image</label>
		<br/><br/>

        <!-- category -->
        <p>Category</p>
        <div class="row">
            <div class="checkbox-grp">
                <input type="checkbox" name="category[]" value="animals"> <!-- category[] makes the input field as part of the array object  -->
                <label for="animals">Animals</label>                <!-- carrying the values associated with their respective categories -->
            </div>

            <div class="checkbox-grp">
                <input type="checkbox" name="category[]" value="fun">
                <label for="funny">Funny</label>
            </div>

            <div class="checkbox-grp">
                <input type="checkbox" name="category[]" value="festive">
                <label for="festive">Festive</label>
            </div>

            <div class="checkbox-grp">
                <input type="checkbox" name="category[]" value="collaborations">
                <label for="collaborations">Collaborations</label>
            </div>
        </div><br/><br/>

        <div class="checkbox-grp-feature">
            <input type="checkbox" name="feature" value="1">
            <label for="feature">Feature on homepage</label>
        </div>

        <!-- hidden input field to pass $pdImg over to `db_editproduct.php` -->
        <input type="hidden" name="pd-img-nochange" value="<?php echo $pdImg; ?>">
		<button type="submit">Save</button>
	</form>
</div>

</body>
</html>