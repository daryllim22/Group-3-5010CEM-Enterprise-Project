<?php
    require("Connectdb.php");

    // initialsing the query variable
    $query = "";

    // if user enters a search query
    if (!empty($userSearch)) {
        //retrieving relevant data from the database
        $query = "SELECT pdID, pdName, pdPrice, pdImage 
                FROM product 
                WHERE pdID IN (SELECT pdID FROM pd_category_relationship WHERE catID = $catID) AND ";
        $query .= "pdName LIKE '%$userSearch%'";
    }
    else {
        // if search field is empty
        //retrieving all data from the database
        $query = "SELECT pdID, pdName, pdPrice, pdImage FROM product WHERE pdID IN (SELECT pdID FROM pd_category_relationship WHERE catID = $catID)";
    }

    // retrieving result from database
    $result = mysqli_query($con, $query);

    //error message if result from query not found
    if (!$result) {
        die('SQL query error: ' . mysqli_error($con));
    }

    //looping through the rows of data to dynamically generate the product box displaying each product saved in the database
    if (mysqli_num_rows($result) > 0){
        while ($tbrow = mysqli_fetch_assoc($result)) {
            $pdID = $tbrow['pdID'];
            $pdImg = $tbrow['pdImage'];
            $pdName = $tbrow['pdName'];
            $pdPrice = $tbrow['pdPrice'];

            //creating the product box and displaying the content
            echo "<a href='product.php?id=$pdID'>";
            echo "    <div class='product-box'>";
            echo "        <img src='$pdImg' alt='product image' width='300' height='300'>";
            echo "        <div class='product-name'><h3>$pdName</h3></div>";
            echo "        <div class='product-price'>RM$pdPrice</div>";
            echo "    </div>";
            echo "</a>";
        }
    }
    else {
        echo "<p style='margin-top: 10%; font-size: 1.5rem;'>Couldn't find the product</p>";
    }


    $con->close();
?>