<?php
include "dbConnect.php";

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

$sql = "INSERT INTO employee (fName, lName, position, salary, sex, DOB, address, phoneNo, 
SSN, bankAcctNo, bankRoutingNo)
VALUES ('$fName','$lName','$position','$salary','$sex','$DOB','$address','$phoneNo',
'$SSN','$bankAcctNo','$bankRoutingNo');";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}

$sql ="INSERT INTO account (username, employeeID)
VALUES (CONCAT('$lName',(SELECT employeeID FROM employee WHERE fName = '$fName' AND DOB = '$DOB')),
(SELECT employeeID FROM employee WHERE fName = '$fName' AND DOB = '$DOB'));";
if (!$conn->query($sql)){
	die("query2 failed:" . $conn->error);
}
header("location: officeManager.html");
?>