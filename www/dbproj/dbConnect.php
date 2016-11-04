<?php
$conn = new mysqli("localhost", "root", "", "dbproj");
if($conn->connect_error){
	die("connection failed: " . $conn->connect_error);
}

session_start();
?>