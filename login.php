<?php
session_start();

include("Connectdb.php");

if ($_SERVER['REQUEST_METHOD']=="POST"){


$uname = $_POST['name'];
$pw = $_POST['pw'];

if(!empty($uname) && !empty($pw)){

$query = "SELECT * from db WHERE name = '$uname' limit 1 ";

$result = mysqli_query($con, $query);

if($result){

if ($result && mysqli_num_rows($result)>0){

	$user_data = mysqli_fetch_assoc($result);

		if(password_verify($pw,$user_data['pw'])){

			//retrieving user ID from the database for the logged in session
			$userID = $user_data['id'];
			$_SESSION['userID'] = $userID;

			if($uname == 'admin'){
				// if admin, direct to admin dashboard
				header("Location: admin.php");
				die;
			}
			else {
				// directing regular users to homepage
				header("Location: index.php");
				die;
			}
		}
	} 
}
echo "Make sure to enter email and password correctly, please try again.";

}else
{
echo "Please make sure to fill in everything.";
}
}
?>

<!DOCTYPE html>
<html lang="utf=8">



<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
 

<nav>
		<img src ="images/logo.png" width="190" height="90">
	<ul>
		<li><a href="index.php"><img src ="images/home.png" width="150" height="50"></a></li>
		<li><a href="products_main.php"><img src ="images/p.png" width="150" height="50"></a></li>
		<li><a href="feedback.php"><img src ="images/fb.png" width="150" height="50"></a></li>
		<li><a href="about_us.php"><img src ="images/au.png" width="150" height="50"></a></li>
	</ul>
</nav>


<div class="layout">
<h1>Login</h1>
	<form action="#" method="post" >
		<p>Username:</p>
		<input type="text" name="name" placeholder="Username">
		<p>Password:</p>
		<input type="password" name="pw" placeholder="Password">
		<br/><br/>
		<a href="su.php">Sign Up Here</a>
		<br/>
		<button type="submit">Login</button>
	</form>
</div>
</div>

</body>
</html>