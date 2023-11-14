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
        </header>
<center>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];


    // Display confirmation message
    echo "<h2>Feedback Confirmed</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Message: $message</p>";

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
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    header('Location: feedback.php');
    exit;
}
?>
</center>
