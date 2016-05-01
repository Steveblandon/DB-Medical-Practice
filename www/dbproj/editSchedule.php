<?php
include "dbConnect.php";

$employeeID = $_POST["employeeID"];
$workDays = $_POST["workDays"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];

$sql = "UPDATE schedule 
SET workDays = '$workDays',
startTime = '$startTime',
endTime = '$endTime' 
WHERE employeeID = '$employeeID'
";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}
else{
	echo "Schedule updated successfully!";
}
?>