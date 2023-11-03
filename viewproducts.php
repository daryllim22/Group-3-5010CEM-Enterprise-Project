<?php

    include("session_handling.php");
    include("Connectdb.php");

    //pulling the data from the product table in the database
    $query = "SELECT pdID, pdName, pdPrice, pdSize, pdStockCount, pdImage FROM product";
    $result = mysqli_query($con, $query);

    //error message if result from query not found
    if (!$result) {
        die('SQL query error: ' . mysqli_error($con));
    }

?>


<!DOCTYPE html>
<html lang="utf=8">



<head>
<title>Admin View Products</title>
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

<!-- table displaying all products -->
<table>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Stock</th>
                <th></th>
            </tr>
<!-- automatically generating the table rows along with the associated product ID -->
<?php
    if (mysqli_num_rows($result) > 0) {
    	while ($tbrow = mysqli_fetch_assoc($result)) {
            $pdID = $tbrow['pdID'];
            $pdImg = $tbrow['pdImage'];
            $pdName = $tbrow['pdName'];
            $pdPrice = $tbrow['pdPrice'];
            $pdSize = $tbrow['pdSize'];
            $pdStockCount = $tbrow['pdStockCount'];

            echo "<tr>";
            echo "    <td><img src='$pdImg'></td>";
            echo "    <td><p>$pdName</p></td>";
            echo "    <td><p>$pdPrice</p></td>";
            echo "    <td><p>$pdSize</p></td>";
            echo "    <td><p>$pdStockCount</p></td>";
            echo "    <td>";
            echo "        <a href='editproduct.php?id=$pdID'>";
            echo "            <button id='editBtn' class='delete'>Edit</button>";
            echo "        </a>";
            echo "        <button id='deleteBtn' class='delete'>Delete</button>";
            echo "    </td>";
            echo "</tr>";
         }
    }
    else {
        echo "<p style='margin-top: 10px; font-size: 1.5rem;'>Looks like your cart is empty...head over to the product section to get your plushie!</p>";
    }
?>



            <!-- <tr>
                <td><img src="images/wingman-plushie.jpeg"></td>
                <td><p>Wingman</p></td>
                <td><p>RM30</p></td>
                <td><p>20cm</p></td>
                <td><p>200</p></td>
                <td>
                    <a href="editproduct.php">
                        <button id="editBtn" class="delete">Edit</button>
                    </a>
                    <button id="deleteBtn" class="delete">Delete</button>
                </td>
            </tr> -->
</table>


        <!-- javascript -->
        <script>
            const delButton = document.getElementById("deleteBtn");

            // listening to user's button clicks
            delButton.addEventListener("click", deletePD);


            // if user clicked on "Delete"
            function deletePD() {
                
            }
        </script>
</body>
</html>