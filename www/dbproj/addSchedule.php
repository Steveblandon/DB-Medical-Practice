<html>
<body>
<?php
include "dbConnect.php";


$employeeID = $_POST["employeeID"];
$workDays = $_POST["workDays"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];

echo "Add Schedule _______________________________<br>";

$sql = "INSERT INTO schedule (employeeID, workDays, startTime, endTime)
VALUES ('$employeeID','$workDays','$startTime','$endTime')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}
else{
	echo "Added Successfully";
}

?>
</body>
</html>