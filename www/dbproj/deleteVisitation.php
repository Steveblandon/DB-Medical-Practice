<?php
include "dbConnect.php";

$date = $_POST["date"];
$patientID = $_POST["patientID"];
$reasonForVisit = $_POST["reasonForVisit"];
$diagnosis = $_POST["diagnosis"];
$serviceType = $_POST["serviceType"];
$date = str_replace("T"," ",$date);

$sql = "DELETE FROM visitation
WHERE patientID = '$patientID' AND date = '$date' ";
if (!$conn->multi_query($sql)){
	die("query failed:" . $conn->error);
}
else{
echo "Medical Test deleted successfully!";
}
?>