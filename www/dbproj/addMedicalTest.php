<html>
<body>
<?php
include "dbConnect.php";

$date = $_POST["date"];
$type = $_POST["type"];
$patientID = $_POST["patientID"];
$testLocation = $_POST["testLocation"];
$aDate = $_POST["aDate"];
$result = $_POST["result"];


echo "Add Medical Test _______________________________<br>";

$sql = "INSERT INTO medicaltest (date, type, patientID, testLocation, aDate, result)
VALUES ('$date','$type','$patientID', '$testLocation', '$aDate', '$result')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}


?>
</body>
</html>