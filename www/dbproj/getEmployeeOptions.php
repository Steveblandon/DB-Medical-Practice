<?php
require "dbConnect.php";

$sql = "SELECT employeeID, fName, lName FROM employee;";


$result = $conn->query($sql);
if (!$result){
	die("query failed" . $conn->error);
}

while($row = $result->fetch_assoc()){
	echo "<option value='" . $row["employeeID"] . "'>" . $row["fName"] . " " . $row["lName"] . " (ID:" .  $row["employeeID"] . ")";
	echo "</option>";
}
?>