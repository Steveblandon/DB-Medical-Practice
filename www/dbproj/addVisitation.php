<html>
<body>
<?php
include "dbConnect.php";

$date = $_POST["date"];
$patientID = $_POST["patientID"];
$reasonForVisit = $_POST["reasonForVisit"];
$diagnosis = $_POST["diagnosis"];
$serviceType = $_POST["serviceType"];
$date = str_replace("T"," ",$date);


echo "Add Visitation";
echo "<br>_______________________________<br>";

$sql = "INSERT INTO visitation (dateTime,  patientID, reasonForVisit, diagnosis, serviceType)
VALUES ('$date', '$patientID', '$reasonForVisit', '$diagnosis',           '$serviceType')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}
else {
	echo "Added Successfully";
}


?>
</body>
</html>