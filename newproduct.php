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


        <!--letting admin upload the new product-->
        <form class="np-page-layout">
            <input type="file" style="border: none;">
            <h3>Name of Product</h3>
            <input type="text" name="product-name" placeholder="Name of Product">
            <input type="text" name="product-price" placeholder="Price">
            <textarea name="product-description" placeholder="Product description"></textarea>
            <input type="submit" >
        </form>
        


        <!--javascript-->
        
    </body>
</html>