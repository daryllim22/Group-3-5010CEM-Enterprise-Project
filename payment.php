<?php

    include("session_handling.php");
    include("Connectdb.php");

    //pulling the data from the cart table in the database
    $query = "SELECT
                Cart.cartID,  
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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
<header>
  <nav>
    <label class="logo"><img src ="images/logo.png" width="190" height="90"></label>
      <ul>
        <li><a href="index.php"><img src ="images/home.png" width="130" height="40"></a></li>
        <li><a href="products_main.php"><img src ="images/p.png" width="130" height="40"></a></li>
        <li><a href="feedback.php"><img src ="images/fb.png" width="130" height="40"></a></li>
        <li><a href="about_us.php"><img src ="images/au.png" width="130" height="40"></a></li>
        <li><a href="cart.php"><img src ="images/cart.png" width="100" height="50"></a></li>
        <li><a href="logout.php"><img src ="images/logout.png" width="100" height="50"></a></li>
      </ul>
  </nav>

</header><br>
<div class="content-margin">
<h2>Checkout</h2><br>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/pay_success.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="johnd@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state">
                <label for="datemin">Date of Payment:</label>
                <input type="date" id="datemin" name="datemin" min="11/11/2023"><br><br>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">                
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="November">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2026">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Pay" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <p><a href="#">Product 1</a> <span class="price">RM</span></p>
      <p><a href="#">Product 2</a> <span class="price">RM</span></p>
      <p>Total <span class="price" style="color:black"><b>RM</b></span></p>
    </div>
  </div>
</div>
</div>

</body>
</html>
