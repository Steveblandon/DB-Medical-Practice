<?php
include "dbConnect.php";

$patientID = $_POST["patientID"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];

$sql = "DELETE FROM patient
WHERE patientID = '$patientID';
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}

echo "employee " . $fName . " " . $lName . " deleted successfully!";
?>