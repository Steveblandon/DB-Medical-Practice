<html>
<body>
<?php
include "dbConnect.php";


$fName = $_POST["fName"];
$lName = $_POST["lName"];
$sex = $_POST["sex"];
$DOB = $_POST["date"];
$address = $_POST["address"];
$phoneNo = $_POST["phoneNo"];
$insuranceProvider = $_POST["insuranceProvider"];
$insuranceNo = $_POST["insuranceNo"];
$insurancePrimary = $_POST["insurancePrimary"];

$sql = "INSERT INTO patient (fName, lName, sex, DOB, address, phoneNo, insuranceProvider, insuranceNo, insurancePrimary)
VALUES ('$fName','$lName','$sex','$DOB','$address','$phoneNo', '$insuranceProvider','$insuranceNo','$insurancePrimary')";
if (!$conn->query($sql)){
	die("query1 failed:" . $conn->error);
}



echo "Patient '" . $fName . " " . $lName . "' added successfully!";
?>
</body>
</html>