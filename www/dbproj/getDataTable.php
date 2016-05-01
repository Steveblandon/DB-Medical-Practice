<?php
require "dbConnect.php";

$sql = "";
//add table connections here
if (strpos(strtolower($_POST["type"]),"employee") != false){
	$sql = "SELECT * FROM employee";
}
else if (strpos(strtolower($_POST["type"]),"service") != false){
	$sql = "SELECT * FROM service";
}
else if (strpos(strtolower($_POST["type"]),"patient") != false){
	$sql = "SELECT * FROM patient";
}
else if (strpos(strtolower($_POST["type"]),"appointment") != false){
	$sql = "SELECT DATE_FORMAT(a.dateTime,'%Y-%m-%d %H:%i') AS date, CONCAT(p.fName,' ', p.lName) AS patient, a.patientID,
	CONCAT(e.fName,' ',e.lName) AS doctor, a.employeeID, a.checkedIn
	FROM appointment a, patient p, employee e
	WHERE a.patientID = p.patientID AND a.employeeID = e.employeeID";
}
else if (strpos(strtolower($_POST["type"]),"healthscreening") != false){
	$sql = "SELECT * FROM healthscreening";
}
else if (strpos(strtolower($_POST["type"]),"immunization") != false){
	$sql = "SELECT * FROM immunization";
}
else if (strpos(strtolower($_POST["type"]),"medicaltest") != false){
	$sql = "SELECT * FROM medicaltest";
}
else if (strpos(strtolower($_POST["type"]),"visitation") != false){
	$sql = "SELECT * FROM visitation";
}
else if (strpos(strtolower($_POST["type"]),"bill") != false){
	$sql = "SELECT * FROM bill";
}
else if (strpos(strtolower($_POST["type"]),"claim") != false){
	$sql = "SELECT * FROM claim";
}
//add table connections here



$result = $conn->query($sql);
if (!$result){
	die("query failed" . $conn->error);
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