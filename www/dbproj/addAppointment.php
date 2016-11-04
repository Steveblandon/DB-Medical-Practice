<?php
include "dbConnect.php";

$checkedIn = $_POST["checkedIn"];
$date = $_POST["date"];
$patientID = $_POST["patient"];
$employeeID = $_POST["doctor"];
$date = str_replace("T"," ",$date);

$sql = "INSERT INTO appointment (dateTime, patientID, employeeID)
VALUES ('$date','$patientID','$employeeID')";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "appointment for " . $date . " added successfully!";
?>