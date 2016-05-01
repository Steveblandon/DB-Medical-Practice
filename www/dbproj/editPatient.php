<?php
include "dbConnect.php";

$patientID = $_POST["patientID"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$sex = $_POST["sex"];
$DOB = $_POST["date"];
$address = $_POST["address"];
$phoneNo = $_POST["phoneNo"];
$insuranceProvider = $_POST["insuranceProvider"];
$insuranceNo = $_POST["insuranceNo"];
$insurancePrimary = $_POST["insurancePrimary"];

$sql = "UPDATE patient SET
fName = '$fName',
lName = '$lName',
sex = '$sex',
DOB = '$DOB',
address = '$address',
phoneNo = '$phoneNo',
insuranceProvider = '$insuranceProvider',
insuranceNo = '$insuranceNo',
insurancePrimary = '$insurancePrimary'
WHERE patientID = '$patientID';";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}


echo "patient " . $fName . " " . $lName . " updated successfully!";
?>