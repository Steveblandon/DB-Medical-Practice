<?php
include "dbConnect.php";

$date = $_POST["date"];
$patientID = $_POST["patientID"];
$smoker = $_POST["smoker"];
$pregnant = $_POST["pregnant"];
$height = $_POST["height"];
$weight = $_POST["weight"];
$bloodPressure = $_POST["bloodPressure"];
$HR = $_POST["HR"];
$currentMedications = $_POST["currentMedications"];
$date = str_replace("T"," ",$date);

$sql = "UPDATE healthscreening
SET $smoker = '$smoker',
$pregnant = '$pregnant',
$height = '$height',
$weight = '$weight',
$bloodPressure = '$bloodPressure',
$HR = '$HR',
$currentMedications = $'currentMedications'
WHERE patientID = '$patientID' AND dateTime = '$date' ";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "HealthScreening for " . $patientID . " updated successfully!";
?>