<?php
require "dbConnect.php";

$sql = "SELECT patientID, fName, lName FROM patient;";


$result = $conn->query($sql);
if (!$result){
	die("query failed" . $conn->error);
}

while($row = $result->fetch_assoc()){
	echo "<option value='" . $row["patientID"] . "'>" . $row["fName"] . " " . $row["lName"] . " (ID:" .  $row["patientID"] . ")";
	echo "</option>";
	
}
?>