<html>
<body>
<?php
include "dbConnect.php";


$employeeID = $_POST["employeeID"];
$workDays = $_POST["workDays"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];

$sql = "SELECT employeeID FROM schedule WHERE employeeID = '$employeeID'";
$result = $conn->query($sql);
if (count($result->fetch_row()) == 0){
	$sql = "INSERT INTO schedule (employeeID, workDays, startTime, endTime)
	VALUES ('$employeeID','$workDays','$startTime','$endTime')";
	if (!$conn->query($sql)){
		die("query1 failed:" . $conn->error);
	}
	else{
		echo "Added Successfully";
	}
	
}
else{
	$sql = "UPDATE schedule 
	SET workDays = '$workDays',
	startTime = '$startTime',
	endTime = '$endTime' 
	WHERE employeeID = '$employeeID'
	";
	if (!$conn->query($sql)){
		die("query1 failed:" . $conn->error);
	}
	else{
		echo "Schedule updated successfully!";
	}
}



?>
</body>
</html>