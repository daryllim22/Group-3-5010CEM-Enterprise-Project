<?php

$con= mysqli_connect("localhost","root","","con_db");

if(!$con){
	die(mysql_error($con));
}
?>