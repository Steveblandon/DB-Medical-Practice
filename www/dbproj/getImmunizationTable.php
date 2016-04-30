<?php
require "dbConnect.php";

$sql = "SELECT p.fName, p.lName, v.* FROM immunization v, patient p WHERE v.patientID = p.patientID";
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