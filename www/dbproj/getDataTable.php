<?php
require "dbConnect.php";

$table = "";
//add table connections here
if (strpos(strtolower($_POST["type"]),"employee") != false){
	$table = "employee";
}
else if (strpos(strtolower($_POST["type"]),"service") != false){
	$table = "service";
}
//add table connections here


$sql = "SELECT * FROM $table";
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