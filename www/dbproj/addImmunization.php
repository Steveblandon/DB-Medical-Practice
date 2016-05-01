<html>
<body>
<?php
include "dbConnect.php";



$patientID = $_POST["patientID"];
$date = $_POST["date"];
$type = $_POST["type"];

echo "Add Immunization _______________________________<br>";

$sql = "INSERT INTO immunization (patientID, date, type)
VALUES ('$patientID','$date','$type')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}


?>
</body>
</html>