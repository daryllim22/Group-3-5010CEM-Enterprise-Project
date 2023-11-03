<?php
    require("session_handling.php");
?>


<!DOCTYPE html>
<html lang="utf=8">
    <head>
        <title>Products: Fun</title>

        <!--css stylesheet-->
        <link rel="stylesheet" type="text/css" href="style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <nav>
                <a href="index.php">
                    <div class="logo"><img src ="images/logo.png" width="190" height="90"></div>
                </a>
                
                <ul>
                    <li><a href="index.php"><img src ="images/home.png" width="130" height="40"></a></li>
                    <li><a href="products_main.php"><img src ="images/p.png" width="130" height="40"></a></li>
                    <li><a href="feedback.php"><img src ="images/fb.png" width="130" height="40"></a></li>
                    <li><a href="about_us.php"><img src ="images/au.png" width="130" height="40"></a></li>

                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>


        <div class="content-margin">
            <h1 style="font-size: 3rem; text-align: center; margin: 40px 0px;">Fun</h1>

            <!-- displaying featured products -->
            <div class="product-section">
                <!-- displaying the products dynamically -->
                <?php include('db_productbox.php'); ?>
            </div>
        </div>



        <!--javascript-->
        
    </body>
</html>