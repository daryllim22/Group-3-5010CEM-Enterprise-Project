<?php
    require("Connectdb.php");

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        if (isset($_POST['product-id'])) {
            // retrieving $pdID from confirmation button
            $pdId = $_POST['product-id'];

            $query = "DELETE FROM carousel_promo WHERE promoImageID = $pdId";
            $result = mysqli_query($con, $query);

            if ($result) {
                header("Location: apromo.php");
            }
            else {
                die("Delete product SQL error: " . mysqli_error($con));
            }
        }
    }
?>