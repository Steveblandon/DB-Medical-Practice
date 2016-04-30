<?php
include "dbConnect.php";

$date = $_POST["date"];
$patientID = $_POST["patientID"];
$date = str_replace("T"," ",$date);

$sql = "DELETE FROM appointment
WHERE patientID = '$patientID' AND dateTime = '$date'";

if (!$conn->query($sql)){
	die("query failed:" . $conn->error);
}

echo "appointment for " . $date . " deleted successfully!";
?>