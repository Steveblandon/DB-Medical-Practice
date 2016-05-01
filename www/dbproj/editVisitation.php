<?php
include "dbConnect.php";

$date = $_POST["date"];
$patientID = $_POST["patientID"];
$reasonForVisit = $_POST["reasonForVisit"];
$diagnosis = $_POST["diagnosis"];
$serviceType = $_POST["serviceType"];
$date = str_replace("T"," ",$date);

$sql = "UPDATE visitation
SET $reasonForVisit = '$reasonForVisit',
$diagnosis = '$diagnosis',
$serviceType = '$serviceType',
WHERE patientID = '$patientID' AND dateTime = '$date' ";

if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}
else{
echo "Visitation for " . $patientID . " updated successfully!";
}
?>