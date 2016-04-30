<?php
include "dbConnect.php";

$employeeID = $_POST["employeeID"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];

$sql = "DELETE FROM employee
WHERE employeeID = '$employeeID';
DELETE FROM account
WHERE employeeID = '$employeeID';
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}

echo "employee " . $fName . " " . $lName . " deleted successfully!";
?>