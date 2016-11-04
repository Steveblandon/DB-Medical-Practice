<?php
include "dbConnect.php";

$patientID = $_POST["patientID"];
$date = $_POST["date"];
$type = $_POST["type"];

$sql = "DELETE FROM immunization
WHERE patientID = '$patientID' AND date = '$date'
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}

echo "immunization deleted successfully!";
?>