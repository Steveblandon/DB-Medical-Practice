<html>
<body>
<?php

$serverName = "localhost";
$username = "root";
$password = "";
$database = "dbproj";

$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}
else echo "Connected to database successfully <br>";

$sql = "
CREATE TABLE Service(
type VARCHAR(50) PRIMARY KEY,
cost FLOAT(8,2) NOT NULL);

CREATE TABLE Employee(
employeeID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
fName VARCHAR(30) NOT NULL,
lName VARCHAR(30) NOT NULL,
position VARCHAR(30) NOT NULL,
salary FLOAT(9,2) NOT NULL,
sex CHAR(1) NOT NULL,
DOB DATE NOT NULL,
address VARCHAR(50) NOT NULL,
phoneNo CHAR(10) NOT NULL,
SSN CHAR(9) NOT NULL,
bankAcctNo VARCHAR(17) NOT NULL,
bankRoutingNo CHAR(9) NOT NULL,
username VARCHAR(20) NOT NULL,
password CHAR(32) NOT NULL);

CREATE TABLE Patient(
patientID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
fName VARCHAR(30) NOT NULL,
lName VARCHAR(30) NOT NULL,
sex CHAR(1),
DOB DATE NOT NULL,
address VARCHAR(50) NOT NULL,
phoneNo CHAR(10) NOT NULL,
insuranceProvider VARCHAR(30),
insuranceNo VARCHAR(10),
insurancePrimary VARCHAR(60));

CREATE TABLE SalaryPaid(
date DATE NOT NULL,
employeeID INT UNSIGNED NOT NULL,
amount FLOAT(9,2) NOT NULL,
PRIMARY KEY (date, employeeID),
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

CREATE TABLE Schedule(
employeeID INT UNSIGNED PRIMARY KEY NOT NULL,
workDays VARCHAR(7) NOT NULL,
startTime TIME NOT NULL,
endTime TIME NOT NULL,
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

CREATE TABLE Immunization(
patientID INT UNSIGNED NOT NULL,
date DATE NOT NULL,
type VARCHAR(30) NOT NULL,
PRIMARY KEY (patientID, date, type),
FOREIGN KEY (patientID) REFERENCES Patient (patientID));

CREATE TABLE Appointment(
dateTime DATETIME NOT NULL,
patientID INT UNSIGNED NOT NULL,
employeeID INT UNSIGNED NOT NULL,
checkedIn CHAR(1) NOT NULL,
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (patientID) REFERENCES Patient (patientID),
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

CREATE TABLE Visitation(
dateTime DATETIME NOT NULL,
patientID INT UNSIGNED NOT NULL,
reasonForVisit TEXT NOT NULL,
diagnosis TEXT NOT NULL,
serviceType VARCHAR(50) NOT NULL,
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID),
FOREIGN KEY (serviceType) REFERENCES Service (type));

CREATE TABLE HealthScreening  (
dateTime DATETIME NOT NULL, 
patientID INT UNSIGNED NOT NULL,
smoker CHAR(1), 
pregnent CHAR(1),
height INT UNSIGNED, 
weight INT UNSIGNED, 
bloodPressure VARCHAR(10), 
HR VARCHAR(10),
currentMedications VARCHAR(50), 
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID));

CREATE TABLE Prescription(
date DATE NOT NULL, 
patientID INT UNSIGNED NOT NULL, 
type VARCHAR(100) NOT NULL,
employeeID INT UNSIGNED NOT NULL,
instruction VARCHAR(100), 
PRIMARY KEY (date, patientID, type),
FOREIGN KEY(patientID) REFERENCES Patient(patientID));

CREATE TABLE MedicalTest (
date DATE NOT NULL, 
type VARCHAR(50) NOT NULL, 
patientID INT UNSIGNED NOT NULL, 
testLocation VARCHAR(50), 
aDate DATE, 
result VARCHAR(100), 
PRIMARY KEY(date, type, patientID),
FOREIGN KEY(patientID) REFERENCES Patient(patientID));

CREATE TABLE Bill(
billNo INT UNSiGNED NOT NULL, 
status_bill VARCHAR(50),
dateTime DATETIME NOT NULL, 
patientID INT UNSIGNED NOT NULL,
amountCharged INT UNSIGNED, 
amountPaid INT UNSIGNED, 
outstandingBalance INT UNSIGNED, 
description VARCHAR(50), 
PRIMARY KEY(billNo),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID));

CREATE TABLE Claim(
billNo INT UNSIGNED NOT NULL, 
amount INT UNSIGNED NOT NULL, 
status_claim VARCHAR(50), 
response VARCHAR(50), 
PRIMARY KEY(billNo),
FOREIGN KEY(billNo) REFERENCES Bill(billNo));
";

/* uncomment to delete tables from database for testing purposes
$sql = "DROP TABLES Visitation, Appointment, Immunization,
Schedule, SalaryPaid, Patient, Employee, Service";
*/

if ($conn->multi_query($sql)){
	echo "successfully created tables <br>";
} 
else echo "Error: " . $conn->error . "<br>";


?>
</body>
</html>
