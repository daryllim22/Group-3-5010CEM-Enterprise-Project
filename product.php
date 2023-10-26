<!-- PHP SQL query -->
<?php
    include("Connectdb.php");

    //retrieving the product ID from the url
    $pdID = $_GET['id'];

    //retrieving the necessary data from the database
    $query = "SELECT pdID, pdName, pdPrice, pdSize, pdStockCount, pdDescription, pdImage FROM product WHERE pdID = $pdID";
    $result = mysqli_query($con, $query);

    //error message if result from query not found
    if (!$result) {
        error_log('SQL querry error: ' . mysqli_error($con));
        die('An error occured. Please try again later.');
    }


    //retrieving the row of data
    $row = mysqli_fetch_assoc($result);

    //error message if product not found in database
    if (!$row) {
        error_log("SQL query error: " . mysqli_error($con));
        die("Product not found.");
    }

    $pdImg = $row['pdImage'];
    $pdName = $row['pdName'];
    $pdPrice = $row['pdPrice'];
    $pdSize = $row['pdSize'];
    $pdStockCount = $row['pdStockCount'];
    $pdDescription = $row['pdDescription'];
?>


<!-- beginning of HTML template -->
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
                    <li><a href="product.html"><img src ="images/p.png" width="130" height="40"></a></li>
                    <li><a href="feedback.html"><img src ="images/fb.png" width="130" height="40"></a></li>
                    <li><a href="au.html"><img src ="images/au.png" width="130" height="40"></a></li>
                </ul>
            </nav>
        </header>

        <div class="content-margin">
        <!--product description here-->
            <div class="pd-pg-wrapper">
                <img src="<?php echo $pdImg ?>" alt="Product Image" width="450rem" height="450rem;">
                <div class="pd-major-deets">
                    <h1 style="font-size: 3rem; flex-wrap: wrap;"><?php echo $pdName; ?></h1>
                    <h2 style="color: rgba(255, 0, 0, 0.858); margin-bottom: 15px">RM<?php echo $pdPrice ?></h2>
                    <h3>Size: <?php echo $pdSize ?>cm</h3>
                    <p>Stock count: <?php echo $pdStockCount ?></p><br/>
                    <h2>Description</h2>
                    <p><?php echo $pdDescription ?></p>

                    <div id="q-select">
                        <label style="font-weight: bold;">Quantity</label>
                        <select name="quantity-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                        </select>
                        <button id="addToCartBtn" style="margin-top: 40px;">Add to cart</button>
                    </div>
                </div>
            </div>
            <!-- printing a success message when item(s) successfully added to cart -->
            <div id="successMessage"></div>
        </div>


        <!-- javascript -->
        <script>
            //obtaining the ID of the current product + quantity that user wants to buy
            let productID = <?php echo $pdID ?>;
            let productQuant = document.getElementById("q-select");
            let selectedQuant = productQuant.value;

            let pdSelData = {
                productID: productID,
                quantity: selectedQuant
            };
            
            const cartButton = document.getElementById("addToCartBtn");
            cartButton.addEventListener("click", addToCart);

            function addToCart() {
                //sending HTTP POST request to the cart PHP script (adding to cart)
                fetch('cart.php', {
                    method: 'POST',
                    body: JSON.stringify(pdSelData),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    //"item(s) successfully added" message
                })
                .catch(error => {
                    //error handling
                })
            }
        </script>
    </body>
</html>