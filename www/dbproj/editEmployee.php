<?php
include "dbConnect.php";

$employeeID = $_POST["employeeID"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$position = $_POST["position"];
$salary = $_POST["salary"];
$sex = $_POST["sex"];
$DOB = $_POST["date"];
$address = $_POST["address"];
$phoneNo = $_POST["phoneNo"];
$SSN = $_POST["ssn"];
$bankAcctNo = $_POST["bankAcctNo"];
$bankRoutingNo = $_POST["bankRoutingNo"];

$sql = "UPDATE employee SET
fName = '$fName',
lName = '$lName',
position = '$position',
salary = '$salary',
sex = '$sex',
DOB = '$DOB',
address = '$address',
phoneNo = '$phoneNo',
SSN = '$SSN',
bankAcctNo = '$bankAcctNo',
bankRoutingNo = '$bankRoutingNo'
WHERE employeeID = '$employeeID';";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

$sql = "UPDATE account SET
username = CONCAT('$lName','$employeeID')
WHERE employeeID = '$employeeID';";
if (!$conn->query($sql)){
	die("query2 failed:" . $conn->error);
}

echo "employee " . $fName . " " . $lName . " updated successfully!";
?>