<?php

    require("session_handling.php");
    include("Connectdb.php");
    
    //retrieving user ID from the URL
    $pdID = $_GET['id'];

    //pulling the current product's data from the database
    $pdQuery = "SELECT pdName, pdPrice, pdSize, pdStockCount, pdDescription, pdImage FROM product WHERE pdID = $pdID";
    $result = mysqli_query($con, $pdQuery);

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


    // ----------------------------------------------------------------------------------------------


    // querying for all product categories
    $pdCategoriesQuery = "SELECT catID, catName FROM product_category WHERE catName <> 'featured'";
    $PCQueryResult = mysqli_query($con, $pdCategoriesQuery);
    // error handling
    if (!$PCQueryResult) {
        die("Product categories SQL error:" . mysqli_error($con));
    }

    // array to hold all product category names from the database
    $dbCategory = array();

    if (mysqli_num_rows($PCQueryResult) > 0) {
        while($allCatRow = mysqli_fetch_assoc($PCQueryResult)) {
            // array to hold all product category names from the database
            $catData = array(
                "cat_id" => $allCatRow['catID'],
                "cat_name" => $allCatRow['catName']
            );

            $dbCategory[] = $catData;
        }
    }

// ---------------------------------------------------------------------------------------------------

    // querying for user selected product categories
    $pdUserCategoryQuery = "SELECT catID FROM pd_category_relationship WHERE pdID = $pdID";
    $PUserCQueryResult = mysqli_query($con, $pdUserCategoryQuery);
    // error handling
    if (!$PUserCQueryResult) {
        die("Product associated category SQL error:" . mysqli_error($con));
    }
    
    // array holding existing product category assign
    $checkedCategory = array();

    if (mysqli_num_rows($PUserCQueryResult) > 0) {
        while($assocCatRow = mysqli_fetch_assoc($PUserCQueryResult)) {
            $checkedCategory[] = $assocCatRow['catID'];
        }
    }


    // closing database connection
    $con->close();
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
			<a href="admin.php">Dashboard</a>
			<a href="apselect.php">Product</a>
			<a href="auser.php">Users</a>
			<a href="index.php">Statistic</a>
			<a href="index.php">Logout</a>
</div>

<div class="layout">
<h1>Edit Product</h1>
    <!-- form sends over to `db_editproduct.php -->
	<form action="db_aeditproduct.php?id=<?php echo $pdID; ?>" method="post" enctype="multipart/form-data">
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
            <?php
                // going through each category in the database and printing out the checkboxes dynamically
                foreach ($dbCategory as $catData) {
                    $catID = $catData['cat_id'];
                    $catName = $catData['cat_name'];

                    echo "<div class='checkbox-grp'>";
                    echo "    <input type='checkbox' name='category[]' value='$catID'";

                        // if the category has already been checked before
                        if (in_array($catID, $checkedCategory)) {
                            echo " checked";
                        }

                    echo ">";
                    echo "    <label for='$catID'>$catName</label>";
                    echo "</div>";
                }
            ?>
        </div><br/><br/>

        <div class="checkbox-grp-feature">
        <?php
            echo "<input type='checkbox' name='category[]' value='1'";
                if (in_array(1, $checkedCategory)) {
                    echo " checked";
                }
            echo ">";
        ?>
            <label for="1">Feature on homepage</label>
        </div>

        <!-- hidden input field to pass $pdImg over to `db_editproduct.php` -->
        <input type="hidden" name="pd-img-nochange" value="<?php echo $pdImg; ?>">
		<button type="submit">Save</button>
	</form>
</div>

</body>
</html>