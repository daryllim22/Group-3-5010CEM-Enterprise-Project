<?php
    require("Connectdb.php");

    //retrieving data from the database
    $query = "SELECT pdID, pdName, pdPrice, pdImage FROM product";
    $result = mysqli_query($con, $query);

    //error message if result from query not found
    if (!$result) {
        die('SQL query error: ' . mysqli_error($con));
    }

    //looping through the rows of data to dynamically generate the product box displaying each product saved in the database
    while ($row = mysqli_fetch_assoc($result)) {
        $pdID = $row['pdID'];
        $pdImg = $row['pdImage'];
        $pdName = $row['pdName'];
        $pdPrice = $row['pdPrice'];

        //creating the product box and displaying the content
        echo "<a href='product.php?id=$pdID'>";
        echo "    <div class='product-box'>";
        echo "        <img src='$pdImg' alt='product image'>";
        echo "        <div class='product-name'><h3>$pdName</h3></div>";
        echo "        <div class='product-price'>RM$pdPrice</div>";
        echo "    </div>";
        echo "</a>";
    }


?>