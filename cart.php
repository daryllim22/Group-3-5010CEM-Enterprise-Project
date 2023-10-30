<?php

    include("session_handling.php");
    include("Connectdb.php");

    //pulling the data from the cart table in the database
    $query = "SELECT
                Cart.cartID, 
                Product.pdImage, 
                Product.pdName, 
                Cart.quantity 
              FROM cart 
              JOIN product ON cart.pdID = product.pdID 
              WHERE userID = '$userID'";
    $result = mysqli_query($con, $query);

    //error message if result from query not found
    if (!$result) {
        die('SQL query error: ' . mysqli_error($con));
    }

?>


<!DOCTYPE html>
<html lang="utf=8">
    <head>
        <title>Shopping Cart</title>

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
                    <li><a href="product.html"><img src ="images/p.png" width="130" height="40"></a></li>
                    <li><a href="feedback.html"><img src ="images/fb.png" width="130" height="40"></a></li>
                    <li><a href="au.html"><img src ="images/au.png" width="130" height="40"></a></li>

                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="content-margin">
            <h1 style="font-size: 3rem; margin-bottom: 25px;">Shopping Cart</h1>
            
            <!-- section to display items in user's cart -->
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($tbrow = mysqli_fetch_assoc($result)) {
                        $cartID = $tbrow['cartID'];
                        $pdImg = $tbrow['pdImage'];
                        $pdName = $tbrow['pdName'];
                        $quantity = $tbrow['quantity'];

                        echo "<div class='cart-box'>";
                        echo "    <div class='cart-box-layout'>";
                        echo "        <table>";
                        echo "            <tr>";
                        echo "                <td><img src='$pdImg'></td>";
                        echo "                <td><p>$pdName</p></td>";
                        echo "                <td><p>x $quantity</p></td>";
                        echo "                <td class='row'>";
                        echo "                    <button>Edit</button>";
                        echo "                    <button>Delete</button>";
                        echo "                </td>";
                        echo "            </tr>";
                        echo "        </table>";
                        echo "    </div>";
                        echo "</div>";
                    }

                    echo "<button>Check Out</button>";
                }
                else {
                    echo "<p style='margin-top: 10px; font-size: 1.5rem;'>Looks like your cart is empty...head over to the product section to get your plushie!</p>";
                }
            ?>

            <!-- <div class="cart-box">
                <div class="cart-box-layout">
                    <table>
                        <tr>
                            <td><img src="images/wingman-plushie.jpeg"></td>
                            <td><p>Wingman Plushie</p></td>
                            <td><p>x 1</p></td>
                            <td class="row">
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div> -->

        </div>

        <!--javascript-->
        
    </body>
</html>