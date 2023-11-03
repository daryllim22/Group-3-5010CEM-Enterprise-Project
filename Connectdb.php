<?php

$con = mysqli_connect("localhost","root","","con_db");

/*if(!$con){
	die(mysqli_error($con));
}*/

if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
?>