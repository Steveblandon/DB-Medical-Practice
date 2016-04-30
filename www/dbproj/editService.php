<?php
include "dbConnect.php";

$type = $_POST["type"];
$cost = $_POST["cost"];

$sql = "UPDATE service SET
cost = '$cost'
WHERE type = '$type';";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "service " . $type . " updated successfully!";
?>