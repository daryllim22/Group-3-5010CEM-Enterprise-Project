<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

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
</nav><br><br>
<center>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $billName = $_POST["billName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $datePay = $_POST["datePay"];
    $cardName = $_POST["cardName"];
    $cardNo = $_POST["cardNo"];
    $expMonth = $_POST["expMonth"];
    $expYear = $_POST["expYear"];


    // Display confirmation message
    echo "<h2>Payment Successful</h2>";
    echo "<p>Bill Name: $billName</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Address: $address</p>";
    echo "<p>City: $city</p>";
    echo "<p>State: $state</p>";
    echo "<p>Zip: $zip</p>";
    echo "<p>Date of Payment: $datePay</p>";
    

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "con_db";

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO payment (billName, email, address, city, state, zip, datePay) VALUES ('$billName', '$email', '$address', '$city', '$state', '$zip', '$datePay')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Payment submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    header('Location: payment.php');
    exit;
}
?>
</center>

</body>
</html>