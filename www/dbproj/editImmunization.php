<?php
include "dbConnect.php";

$patientID = $_POST["patientID"];
$date = $_POST["date"];
$type = $_POST["type"];

$sql = "UPDATE immunization SET
type = '$type'
WHERE patientID = '$patientID' AND date ='$date'";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

echo "immunization updated successfully!";
?>