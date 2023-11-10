<!DOCTYPE html>
<html lang="utf=8">
    <head>
        <title>Santa's Plushie Factory</title>

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


        <h1 class="welcome-title">Welcome to Santa's Plushie Factory</h1>


        <!--carousel of promotions here-->
        <div class="carousel-container">
            <span>will come back to this later</span>
        </div>


        <!-- displaying featured products -->
        <div class="product-section">
            <!-- setting the category of items to display -->
            <?php $catID = 1; ?>

            <!-- displaying the products dynamically -->
            <?php include('db_productbox.php'); ?>
        </div>



        <!--javascript-->
        
    </body>
</html>