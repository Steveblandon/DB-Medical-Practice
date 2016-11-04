<?php
include "dbConnect.php";


$date = $_POST["date"];
$type = $_POST["type"];
$patientID = $_POST["patientID"];
$testLocation = $_POST["testLocation"];
$aDate = $_POST["aDate"];
$result = $_POST["result"];

$sql = "UPDATE medicaltest SET
type = '$type',
testLocation = '$testLocation',
aDate = '$aDate',
result = '$result'
WHERE patientID = '$patientID' AND date ='$date'";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "Medical Test updated successfully!";
?>