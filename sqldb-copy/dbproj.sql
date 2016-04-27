DROP DATABASE IF EXISTS dbproj;
CREATE DATABASE IF NOT EXISTS dbproj;

USE dbproj;

DROP TABLE IF EXISTS Service;
CREATE TABLE IF NOT EXISTS Service(
type VARCHAR(50) PRIMARY KEY,
cost FLOAT(8,2) NOT NULL);

INSERT INTO Service (type, cost)
VALUES ('General', '100.00');

INSERT INTO Service (type, cost)
VALUES ('physical', '200.00');

DROP TABLE IF EXISTS Employee;
CREATE TABLE IF NOT EXISTS Employee(
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
bankRoutingNo CHAR(9) NOT NULL);

INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo)
VALUES ('John','Krugger','Doctor',100000.00,'M', '19771105','11 Short Ave',
'1234567890', '123456789', '13413354623', '123457689');

INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo)
VALUES ('Katie','Ramos','Assistant',43000.00,'F', '19911223','45 Hubbert St',
'1234657890', '132456789', '15624322652', '123789456');

INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo) 
VALUES('Sarah','Moses','Nurse',30000.00,'F','1960-04-04','11480 Dixwell Ave','2034987472',
'333445555', '47890243278', '47328978');
INSERT INTO Employee (fName, lName, position, salary, sex, 
DOB, address, phoneNo, SSN, bankAcctNo, bankRoutingNo) 
VALUES ('Ben', 'Flinestone','Office Manager', 90000.00, 'M', '1976-04-02', 
'78923 Walley Ave', '2034986666', '777889999', '72843904398', '23798432');

DROP TABLE IF EXISTS Account;
CREATE TABLE IF NOT EXISTS Account(
username VARCHAR(20) NOT NULL PRIMARY KEY,
password CHAR(32),
employeeID INT UNSIGNED,
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

INSERT INTO Account (username, employeeID)
VALUES ("Krugger1",1);
INSERT INTO Account (username, employeeID)
VALUES ("Ramos2",2);
INSERT INTO Account (username, employeeID)
VALUES ("Moses3",3);
INSERT INTO Account (username, employeeID)
VALUES ("Flinestone4",4);

DROP TABLE IF EXISTS Patient;
CREATE TABLE IF NOT EXISTS Patient(
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

INSERT INTO Patient (fName, lName, sex, DOB, address, phoneNo, insuranceProvider,
insuranceNo, insurancePrimary)
VALUES ('James','Osborne','M','19650612','23 Roger St','1234567890','Cigna','21352845',
'James Osborne');

INSERT INTO Patient (fName, lName, sex, DOB, address, phoneNo, insuranceProvider,
insuranceNo, insurancePrimary)
VALUES ('Kenneth','Robertino','M','19780716','35 Lumbar St','1234569870','OnePlus','753155946',
'Robert Robertino');

DROP TABLE IF EXISTS SalaryPaid;
CREATE TABLE IF NOT EXISTS SalaryPaid(
date DATE NOT NULL,
employeeID INT UNSIGNED NOT NULL,
amount FLOAT(9,2) NOT NULL,
PRIMARY KEY (date, employeeID),
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

INSERT INTO SalaryPaid (date, employeeID, amount)
VALUES (CURDATE(),1,(SELECT salary FROM Employee WHERE employeeID = 1) / 12);

INSERT INTO SalaryPaid (date, employeeID, amount)
VALUES (CURDATE(),2,(SELECT salary FROM Employee WHERE employeeID = 2) / 12);

DROP TABLE IF EXISTS Schedule;
CREATE TABLE IF NOT EXISTS Schedule(
employeeID INT UNSIGNED PRIMARY KEY NOT NULL,
workDays VARCHAR(7) NOT NULL,
startTime TIME NOT NULL,
endTime TIME NOT NULL,
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

INSERT INTO Schedule (employeeID, workDays, startTime, endTime)
VALUES (1,'MWF',CURTIME(),DATE_ADD(CURTIME(),INTERVAL 8 HOUR));

INSERT INTO Schedule (employeeID, workDays, startTime, endTime)
VALUES (2,'MTWRF',CURTIME(),DATE_ADD(CURTIME(),INTERVAL 8 HOUR));

DROP TABLE IF EXISTS Immunization;
CREATE TABLE IF NOT EXISTS Immunization(
patientID INT UNSIGNED NOT NULL,
date DATE NOT NULL,
type VARCHAR(30) NOT NULL,
PRIMARY KEY (patientID, date, type),
FOREIGN KEY (patientID) REFERENCES Patient (patientID));

INSERT INTO Immunization (patientID, date, type)
VALUES (1,'20020515','measles');

INSERT INTO Immunization (patientID, date, type)
VALUES (2,'19990722','varicella');

DROP TABLE IF EXISTS Appointment;
CREATE TABLE IF NOT EXISTS Appointment(
dateTime DATETIME NOT NULL,
patientID INT UNSIGNED NOT NULL,
employeeID INT UNSIGNED NOT NULL,
checkedIn CHAR(1) NOT NULL,
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (patientID) REFERENCES Patient (patientID),
FOREIGN KEY (employeeID) REFERENCES Employee (employeeID));

INSERT INTO Appointment (datetime, patientID, employeeID, checkedIn)
VALUES (CURTIME(),1,1,'Y');

INSERT INTO Appointment (datetime, patientID, employeeID, checkedIn)
VALUES (DATE_ADD(CURTIME(),INTERVAL 3 HOUR),2,1,'Y');
INSERT INTO Appointment (`dateTime`, `patientID`, `employeeID`, `checkedIn`) VALUES
('2016-04-25 12:22:00', 2, 5, 'N'),
('2016-04-25 14:37:59', 1, 1, 'Y'),
('2016-04-25 17:37:59', 2, 1, 'Y');

DROP TABLE IF EXISTS Visitation;
CREATE TABLE IF NOT EXISTS Visitation(
dateTime DATETIME NOT NULL,
patientID INT UNSIGNED NOT NULL,
reasonForVisit TEXT NOT NULL,
diagnosis TEXT NOT NULL,
serviceType VARCHAR(50) NOT NULL,
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID),
FOREIGN KEY (serviceType) REFERENCES Service (type));


DROP TABLE IF EXISTS HealthScreening;
CREATE TABLE IF NOT EXISTS HealthScreening(
dateTime DATETIME NOT NULL, 
patientID INT UNSIGNED NOT NULL,
smoker CHAR(1), 
pregnant CHAR(1),
height VARCHAR(6), 
weight INT(3) UNSIGNED, 
bloodPressure VARCHAR(7), 
HR VARCHAR(10),
currentMedications VARCHAR(50), 
PRIMARY KEY (dateTime, patientID),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID));
INSERT INTO `healthscreening` (`dateTime`, `patientID`, `smoker`, `pregnant`, `height`, `weight`, `bloodPressure`, `HR`, `currentMedications`) VALUES
('2016-04-25 12:22:00', 2, 'Y', 'N', '5 9', 175, '150/75', '90', NULL),
('2016-04-25 14:37:59', 1, 'N', 'N', '5 2', 190, '200/100', '96', 'Diabetes Medications');


DROP TABLE IF EXISTS Prescription;
CREATE TABLE IF NOT EXISTS Prescription(
date DATE NOT NULL, 
patientID INT UNSIGNED NOT NULL, 
type VARCHAR(50) NOT NULL,
employeeID INT UNSIGNED NOT NULL,
instruction VARCHAR(100), 
PRIMARY KEY (date, patientID, type),
FOREIGN KEY(patientID) REFERENCES Patient(patientID));


DROP TABLE IF EXISTS MedicalTest;
CREATE TABLE IF NOT EXISTS MedicalTest(
date DATE NOT NULL, 
type VARCHAR(50) NOT NULL, 
patientID INT UNSIGNED NOT NULL, 
testLocation VARCHAR(50), 
aDate DATE, 
result VARCHAR(100), 
PRIMARY KEY(date, type, patientID),
FOREIGN KEY(patientID) REFERENCES Patient(patientID));
INSERT INTO MedicalTest (`date`, `type`, `patientID`, `testLocation`, `aDate`, `result`) VALUES
('2016-04-25', 'XRay', 1, 'New Haven, Yale Hospital', '2016-04-26', 'Negative'),
('2016-04-26', 'Blood Draw', 2, 'New Haven, Yale Hospital', '2016-04-27', 'Diabetes Test');


DROP TABLE IF EXISTS Bill;
CREATE TABLE IF NOT EXISTS Bill(
billNo INT UNSIGNED AUTO_INCREMENT NOT NULL, 
status_bill VARCHAR(20),
dateTime DATETIME NOT NULL, 
patientID INT UNSIGNED NOT NULL,
amountCharged FLOAT(9,2), 
amountPaid FLOAT(9,2), 
outstandingBalance FLOAT(9,2), 
serviceType VARCHAR(50),
PRIMARY KEY(billNo),
FOREIGN KEY (dateTime, patientID) REFERENCES Appointment (dateTime, patientID),
FOREIGN KEY (serviceType) REFERENCES Service (type));


DROP TABLE IF EXISTS Claim;
CREATE TABLE IF NOT EXISTS Claim(
billNo INT UNSIGNED NOT NULL, 
amount FLOAT(9,2), 
status_claim VARCHAR(50), 
response VARCHAR(50), 
PRIMARY KEY(billNo),
FOREIGN KEY(billNo) REFERENCES Bill(billNo));