<?php
include "dbConnect.php";

$patientID = $_POST["patientID"];
$date = $_POST["date"];



$sql = "DELETE FROM healthscreening
WHERE patientID = '$patientID' AND  dateTime = '$date';
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}

echo "deleted successfully!";
?>