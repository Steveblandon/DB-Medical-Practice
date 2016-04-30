<?php
include "dbConnect.php";

$type = $_POST["type"];
$cost = $_POST["cost"];

echo $cost;

$sql = "INSERT INTO service (type,cost)
VALUES ('$type','$cost');";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "service " . $type . " added successfully!";
?>