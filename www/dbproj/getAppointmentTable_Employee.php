<?php
require "dbConnect.php";

$sql = "SELECT a.employeeID, e.fName, e.lName, p.patientID, p.fName, p.lName, a.dateTime, a.checkedIn FROM appointment a, employee e, patient p WHERE e.employeeID = a.employeeID  AND a.patientID = p.patientID ORDER BY e.employeeID";
$result = $conn->query($sql);
if (!$result){
	die("query failed");
}

echo "<thead><tr>";
while($field = $result->fetch_field()){
	echo "<th>" . $field->name . "</th>";
}
echo "</tr></thead>";
echo "<tbody>";
while($row = $result->fetch_row()){
	$i = 0;
	$max = count($row);
	echo "<tr>";
	while($i < $max){
		echo "<td>" . $row[$i] . "</td>";
		$i++;
	}
	echo "</tr>";
}
?>