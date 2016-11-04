<?php
include "dbConnect.php";

$checkedIn = $_POST["checkedIn"];
$date = $_POST["date"];
$patientID = $_POST["patient"];
$date = str_replace("T"," ",$date);

$sql = "UPDATE appointment SET
checkedIn = '$checkedIn'
WHERE patientID = '$patientID' AND dateTime = '$date';";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "appointment for " . $date . " updated successfully!";
?>