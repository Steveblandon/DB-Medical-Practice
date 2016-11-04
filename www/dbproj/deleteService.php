<?php
include "dbConnect.php";

$type = $_POST["type"];
$cost = $_POST["cost"];

$sql = "DELETE FROM service
WHERE type = '$type';";

if (!$conn->query($sql)){
	die("query failed:" . $conn->error);
}

echo "service " . $type . " deleted successfully!";
?>