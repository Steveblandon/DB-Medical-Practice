<html>
<body>

$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error){
	die('Connection failed' . $conn->connect_error);
}
else echo 'Connected to database successfully <br>';

function generateNumStr($size){
	$num = '';
	for ($x = 1; $x <= $size; $x++){
		$num .= strval(rand(0,9));
	}
	return $num;
}
/*
$sql = " 
INSERT INTO Service (type, cost)
VALUES ('General', '100.00');
<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$database = 'hospitalDB';

INSERT INTO Service (type, cost)
VALUES ('physical', '200.00');
";

$val = [
	1 => generateNumStr(10),
	2 => generateNumStr(9),
	3 => generateNumStr(15),
	4 => generateNumStr(9)
];
$pass = hash("MD5","John1977");
$sql .= "
INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo, username, password)
VALUES ('John','Krugger','Doctor',100000.00,'M', '19771105','11 Short Ave',
'$val[1]', '$val[2]', '$val[3]', '$val[4]', CONCAT(lName, 1), '$pass');
";

$val = [
	1 => generateNumStr(10),
	2 => generateNumStr(9),
	3 => generateNumStr(15),
	4 => generateNumStr(9)
];
$pass = hash("MD5","Katie1991");
$sql .= "
INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo, username, password)
VALUES ('Katie','Ramos','Assistant',43000.00,'F', '19911223','45 Hubbert St',
'$val[1]', '$val[2]', '$val[3]', '$val[4]', CONCAT(lName, 2), '$pass');
";

$val = [
	1 => generateNumStr(10),
	2 => generateNumStr(10)
];
$sql .= "
INSERT INTO Patient (fName, lName, sex, DOB, address, phoneNo, insuranceProvider,
insuranceNo, insurancePrimary)
VALUES ('James','Osborne','M','19650612','23 Roger St','$val[1]','Cigna','$val[2]',
'James Osborne');
";

$val = [
	1 => generateNumStr(10),
	2 => generateNumStr(10)
];
$sql .= "
INSERT INTO Patient (fName, lName, sex, DOB, address, phoneNo, insuranceProvider,
insuranceNo, insurancePrimary)
VALUES ('Kenneth','Robertino','M','19780716','35 Lumbar St','$val[1]','OnePlus','$val[2]',
'Robert Robertino');
";

$sql .= "
INSERT INTO SalaryPaid (date, employeeID, amount)
VALUES (CURDATE(),1,(SELECT salary FROM Employee WHERE employeeID = 1) / 12);

INSERT INTO SalaryPaid (date, employeeID, amount)
VALUES (CURDATE(),2,(SELECT salary FROM Employee WHERE employeeID = 2) / 12);

INSERT INTO Schedule (employeeID, workDays, startTime, endTime)
VALUES (1,'MWF',CURTIME(),DATE_ADD(CURTIME(),INTERVAL 8 HOUR));

INSERT INTO Schedule (employeeID, workDays, startTime, endTime)
VALUES (2,'MTWRF',CURTIME(),DATE_ADD(CURTIME(),INTERVAL 8 HOUR));

INSERT INTO Immunization (patientID, date, type)
VALUES (1,'20020515','measles');

INSERT INTO Immunization (patientID, date, type)
VALUES (2,'19990722','varicella');

INSERT INTO Appointment (datetime, patientID, employeeID, checkedIn)
VALUES (CURTIME(),1,1,'Y');

INSERT INTO Appointment (datetime, patientID, employeeID, checkedIn)
VALUES (DATE_ADD(CURTIME(),INTERVAL 3 HOUR),2,1,'Y');
";
*/ 
$sql = "
INSERT INTO Visitation(dateTime, patientID, reasonForVisit, serviceType) 
VALUES (CURDATE(), 1, 'Cough', 'Flu', 'General'); 

"; 


if($conn -> query($sql) == TRUE ){
	echo "<br/>";
	echo "Insertion Successfull";
}
else {
	echo "<br/>";
	echo "Error: " . $conn -> error; 
}

/* uncomment to delete tables from database for testing purposes
$sql = "REMOVE * FROM Service;

";


if ($conn->multi_query($sql)){
	echo "successfully filled database with data <br>";
} 
else echo "Error: " . $conn->error . "<br>";
*/

?>
</body>
</html>
