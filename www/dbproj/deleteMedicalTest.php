<?php
include "dbConnect.php";

$date = $_POST["date"];
$type = $_POST["type"];
$patientID = $_POST["patientID"];
$testLocation = $_POST["testLocation"];
$aDate = $_POST["aDate"];
$result = $_POST["result"];

$sql = "DELETE FROM medicaltest
WHERE patientID = '$patientID' AND date = '$date' AND aDate = '$aDate' AND result = '$result'
";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}

echo "Medical Test deleted successfully!";
?>