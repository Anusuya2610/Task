<?php

$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "employee_admin";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

if(!$conn){
	echo "Databese Connection Failed";
}

?>