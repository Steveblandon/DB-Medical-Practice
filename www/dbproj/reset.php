<?php

//run this script to reset database for debugging purposes

$conn = new mysqli('localhost','root','');

if ($conn->connect_error){
	die('Connection failed' . $conn->connect_error);
}

$sql = "
DROP DATABASE dbproj;
CREATE DATABASE dbproj;
";

if ($conn->multi_query($sql)){
	echo "reset <br>";
} 
else echo "Error: " . $conn->error . "<br>";

$conn->close();

include 'createDB.php';
//comment the next line if you need empty tables
include 'fillDB.php';
?>