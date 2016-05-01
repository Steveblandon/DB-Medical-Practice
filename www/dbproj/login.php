<?php 
require "dbConnect.php";

$username = $_POST["username"];

$sql = "SELECT position FROM employee WHERE employeeID = (SELECT employeeID FROM account WHERE username = '$username');"; 

$result = $conn->query($sql);
if (!$result){
	die("query failed" . $conn->error);
}
$entry = $result->fetch_row();
$entry = $entry[0];
switch($entry){
	case "Nurse":
		echo "Location:nurse.html";
		break;
	case "Doctor":
		echo "Location:doctor.html";
		break;
	case "Assistant":
		echo "Location:assistant.html";
		break;
	case "Office Manager":
		echo "Location:officeManager.html";
		break;
	default:
		echo "You've entered an incorrect username or password!";
}
?> 