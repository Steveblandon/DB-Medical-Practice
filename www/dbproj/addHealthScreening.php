<html>
<body>
<?php
include "dbConnect.php";


$date = $_POST["date"];
$patientID = $_POST["patientID"];
$smoker = $_POST["smoker"];
$pregnant = $_POST["pregnant"];
$height = $_POST["height"];
$weight = $_POST["weight"];
$bloodPressure = $_POST["bloodPressure"];
$HR = $_POST["HR"];
$currentMedications = $_POST["currentMedications"];
$date = str_replace("T"," ",$date);


echo "Add Health Screening _______________________________<br>";

$sql = "INSERT INTO healthscreening (dateTime, patientID, smoker, pregnant, height, weight, bloodPressure, HR, currentMedications)
VALUES ('$date','$patientID','$smoker','$pregnant','$height','$weight','$bloodPressure','$HR','$currentMedications')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}


echo "Added New Row";
?>
</body>
</html>