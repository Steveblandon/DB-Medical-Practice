<?php
include "dbConnect.php";

$employeeID = $_POST["employeeID"];
$workDays = $_POST["workDays"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];

$sql = "DELETE FROM schedule
WHERE employeeID = '$employeeID' ;
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}
else{
	echo "Employee deleted successfully!";
}
?>