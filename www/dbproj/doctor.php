<html> 
<head> 

</head>
<body> 
<?php 

//connect to database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{	
	echo "";
} 

if ( isset( $_POST['Submit1'] ) ) { 
	/////////////////view patient info

	$value1 = $_POST['table'];
	$value2 = $_POST['Name'];

	if($value1 == 'patient'){
			echo "Patient Info: ";
			$sql = "SELECT * FROM patient WHERE fName LIKE '%$value2%' OR lName LIKE '%$value2%' ";
			$result = $conn -> query($sql);
			$count = 1; 
			echo "<table border = '1'>";
			if($result -> num_rows > 0 ){
				while($row = $result->fetch_assoc()) {
					if($count == 1){
						echo "<tr>";
					   	echo "<td>Patient ID: </td>".
					   		" <td>Name: </td>".
					   		" <td>Sex: </td>".
					   		" <td>Date of Birth </td>".
					   		" <td>Address </td>".
					   		" <td>Phone Number: </td>".
					   		" <td>Insurance: </td>".
					   		" <td>Insurance Number: </td>".
					   		" <td>Insurance Primary: </td>"; 
					   	echo "</tr>";
					    echo "<tr>"; 
					   	echo "<td>". $row["patientID"]."</td>".
					   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
					   		" <td>". $row["sex"]. "</td>".
					   		" <td>". $row["DOB"]. "</td>".
					   		" <td contenteditable='true' id = 'address1'>". $row["address"]. "</td>".
					   		" <td>". $row["phoneNo"]. "</td>".
					   		" <td>". $row["insuranceProvider"]. "</td>".
					   		" <td>". $row["insuranceNo"]. "</td>".
					   		" <td>". $row["insurancePrimary"]. "</td>"; 
					   	echo "</tr>";
					   	$count++;
				 	  }
				 	  else {
				 	  	echo "<tr>";
					   	echo "<td>". $row["patientID"]."</td>".
					   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
					   		" <td>". $row["sex"]. "</td>".
					   		" <td>". $row["DOB"]. "</td>".
					   		" <td>". $row["address"]. "</td>".
					   		" <td>". $row["phoneNo"]. "</td>".
					   		" <td>". $row["insuranceProvider"]. "</td>".
					   		" <td>". $row["insuranceNo"]. "</td>".
					   		" <td>". $row["insurancePrimary"]. "</td>"; 
					   	echo "</tr>";
				 	  }
				   }
				}
			echo "</table>";
	}
	else if ($value1 == 'appointment'){
		echo "appointment";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, p.DOB AS pDOB, p.address AS pAddress, e.employeeID AS employeeID, e.fName AS eFName, e.lName AS eLName, e.position AS position 
				FROM appointment a, patient p, employee e 
				WHERE a.patientID = p.patientID AND e.employeeID = a.employeeID AND (p.fName LIKE '%$value2%' OR p.lName LIKE '%$value2%')"; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date of Birth </td>".
				   		" <td>Address </td>".
				   		" <td>EmployeeID </td>".
				   		" <td>Employee Name </td>".
				   		" <td>Position </td>"; 
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["pDOB"]. "</td>".
				   		" <td>". $row["pAddress"]. "</td>".
				   		" <td>". $row["employeeID"]. "</td>".
				   		" <td>". $row["eFName"]. " " .$row["eLName"]."</td>".
				   		" <td>". $row["position"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["pDOB"]. "</td>".
				   		" <td>". $row["pAddress"]. "</td>".
				   		" <td>". $row["employeeID"]. "</td>".
				   		" <td>". $row["eFName"]. " " .$row["eLName"]."</td>".
				   		" <td>". $row["position"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'healthscreening'){
		echo "screening";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, h.dateTime AS dateTime, h.smoker AS smoker, h.pregnant as pregnant, h.height AS height, h.weight AS weight, h.bloodPressure AS bloodPressure, h.HR AS HR, h.currentMedications AS currentMedications 
				FROM healthscreening h, patient p
				WHERE h.patientID = p.patientID AND (p.fName LIKE '%$value2%' OR p.lName LIKE '%$value2%')"; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date/Time </td>".
				   		" <td>Smoker? </td>".
				   		" <td>Pregnant? </td>".
				   		" <td>Height </td>".
				   		" <td>Weight </td>".
				   		" <td>Blood Pressure   </td>".
				   		" <td>Heart Rate </td>".
				   		" <td>Current Medications  </td>"; 
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateTime"]. "</td>".
				   		" <td>". $row["smoker"]. "</td>".
				   		" <td>". $row["pregnant"]. "</td>".
				   		" <td>". $row["height"]. "</td>".
				   		" <td>". $row["weight"]. "</td>".
				   		" <td>". $row["bloodPressure"]. "</td>".
				   		" <td>". $row["HR"]. "</td>".
				   		" <td>". $row["currentMedications"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateTime"]. "</td>".
				   		" <td>". $row["smoker"]. "</td>".
				   		" <td>". $row["pregnant"]. "</td>".
				   		" <td>". $row["height"]. "</td>".
				   		" <td>". $row["weight"]. "</td>".
				   		" <td>". $row["bloodPressure"]. "</td>".
				   		" <td>". $row["HR"]. "</td>".
				   		" <td>". $row["currentMedications"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'immunization'){
		echo "immunization";

		$sql = "SELECT p.patientID as patID, p.fName AS pFName, p.lName AS pLName, i.date AS date, i.type AS type
				FROM immunization i, patient p
				WHERE i.patientID = p.patientID  AND (p.fName LIKE '%$value2%' OR p.lName LIKE '%$value2%')";
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date </td>".
				   		" <td>Type </td>";
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'medicaltest'){
		echo "tests";
		$sql = "SELECT p.patientID as patID, p.fName AS pFName, p.lName AS pLName, m.date AS date, m.type as type, m.testLocation AS testLocation, m.aDate AS aDate, m.result as result 
				FROM medicaltest m, patient p
				WHERE m.patientID = p.patientID AND (p.fName LIKE '%$value2%' OR p.lName LIKE '%$value2%') 
				ORDER BY patID";
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date Made </td>".
				   		" <td>Type </td>".
				   		" <td>Test Location </td>".
				   		" <td>Appointment Date </td>".
				   		" <td>Result </td>"	;
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>".
				   		" <td>". $row["testLocation"]. "</td>".
				   		" <td>". $row["aDate"]. "</td>".
				   		" <td>". $row["result"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo"<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>".
				   		" <td>". $row["testLocation"]. "</td>".
				   		" <td>". $row["aDate"]. "</td>".
				   		" <td>". $row["result"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'visitation'){
		echo "visit";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, v.dateTime AS dateT, v.reasonForVisit AS reason, v.diagnosis AS diagnosis, v.serviceType AS service
				FROM visitation v, patient p
				WHERE v.patientID = p.patientID AND (p.fName LIKE '%$value2%' OR p.lName LIKE '%$value2%')
				ORDER BY p.patientID"; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>DateTime </td>".
				   		" <td>Reason </td>".
				   		" <td>Diagnosis </td>".
				   		" <td>Service </td>";
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateT"]. "</td>".
				   		" <td>". $row["reason"]. "</td>".
				   		" <td>". $row["diagnosis"]. "</td>".
				   		" <td>". $row["service"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateT"]. "</td>".
				   		" <td>". $row["reason"]. "</td>".
				   		" <td>". $row["diagnosis"]. "</td>".
				   		" <td>". $row["service"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else 
		echo "NOPE";

}//end Submit1

else if ( isset( $_POST['Submit1_1'] ) ) { 
	/////////////////view patient info

	$value1 = $_POST['table'];
	$value2 = $_POST['Name'];
/// view all patient info no matter what 
	if($value1 == 'patient'){
			//view all patient's 
		
			echo "Patient Info: ";
			$sql = "SELECT * FROM patient";
			$result = $conn -> query($sql);
			$count = 1; 
			echo "<table border = '1'>";
			if($result -> num_rows > 0 ){
				while($row = $result->fetch_assoc()) {
					if($count == 1){
						echo "<tr>";
					   	echo "<td>Patient ID: </td>".
					   		" <td>Name: </td>".
					   		" <td>Sex: </td>".
					   		" <td>Date of Birth </td>".
					   		" <td>Address </td>".
					   		" <td>Phone Number: </td>".
					   		" <td>Insurance: </td>".
					   		" <td>Insurance Number: </td>".
					   		" <td>Insurance Primary: </td>"; 
					   	echo "</tr>";
					    echo "<tr>"; 
					   	echo "<td>". $row["patientID"]."</td>".
					   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
					   		" <td>". $row["sex"]. "</td>".
					   		" <td>". $row["DOB"]. "</td>".
					   		" <td contenteditable='true' id = 'address1'>". $row["address"]. "</td>".
					   		" <td>". $row["phoneNo"]. "</td>".
					   		" <td>". $row["insuranceProvider"]. "</td>".
					   		" <td>". $row["insuranceNo"]. "</td>".
					   		" <td>". $row["insurancePrimary"]. "</td>"; 
					   	echo "</tr>";
					   	$count++;
				 	  }
				 	  else {
				 	  	echo "<tr>";
					   	echo "<td>". $row["patientID"]."</td>".
					   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
					   		" <td>". $row["sex"]. "</td>".
					   		" <td>". $row["DOB"]. "</td>".
					   		" <td>". $row["address"]. "</td>".
					   		" <td>". $row["phoneNo"]. "</td>".
					   		" <td>". $row["insuranceProvider"]. "</td>".
					   		" <td>". $row["insuranceNo"]. "</td>".
					   		" <td>". $row["insurancePrimary"]. "</td>"; 
					   	echo "</tr>";
				 	  }
				   }
				}
			echo "</table>";
	}
	else if ($value1 == 'appointment'){
		echo "appointment";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, p.DOB AS pDOB, p.address AS pAddress, e.employeeID AS employeeID, e.fName AS eFName, e.lName AS eLName, e.position AS position 
				FROM appointment a, patient p, employee e 
				WHERE a.patientID = p.patientID AND e.employeeID = a.employeeID )"; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date of Birth </td>".
				   		" <td>Address </td>".
				   		" <td>EmployeeID </td>".
				   		" <td>Employee Name </td>".
				   		" <td>Position </td>"; 
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["pDOB"]. "</td>".
				   		" <td>". $row["pAddress"]. "</td>".
				   		" <td>". $row["employeeID"]. "</td>".
				   		" <td>". $row["eFName"]. " " .$row["eLName"]."</td>".
				   		" <td>". $row["position"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["pDOB"]. "</td>".
				   		" <td>". $row["pAddress"]. "</td>".
				   		" <td>". $row["employeeID"]. "</td>".
				   		" <td>". $row["eFName"]. " " .$row["eLName"]."</td>".
				   		" <td>". $row["position"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'healthscreening'){
		echo "screening";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, h.dateTime AS dateTime, h.smoker AS smoker, h.pregnant as pregnant, h.height AS height, h.weight AS weight, h.bloodPressure AS bloodPressure, h.HR AS HR, h.currentMedications AS currentMedications 
				FROM healthscreening h, patient p
				WHERE h.patientID = p.patientID "; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date/Time </td>".
				   		" <td>Smoker? </td>".
				   		" <td>Pregnant? </td>".
				   		" <td>Height </td>".
				   		" <td>Weight </td>".
				   		" <td>Blood Pressure   </td>".
				   		" <td>Heart Rate </td>".
				   		" <td>Current Medications  </td>"; 
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateTime"]. "</td>".
				   		" <td>". $row["smoker"]. "</td>".
				   		" <td>". $row["pregnant"]. "</td>".
				   		" <td>". $row["height"]. "</td>".
				   		" <td>". $row["weight"]. "</td>".
				   		" <td>". $row["bloodPressure"]. "</td>".
				   		" <td>". $row["HR"]. "</td>".
				   		" <td>". $row["currentMedications"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateTime"]. "</td>".
				   		" <td>". $row["smoker"]. "</td>".
				   		" <td>". $row["pregnant"]. "</td>".
				   		" <td>". $row["height"]. "</td>".
				   		" <td>". $row["weight"]. "</td>".
				   		" <td>". $row["bloodPressure"]. "</td>".
				   		" <td>". $row["HR"]. "</td>".
				   		" <td>". $row["currentMedications"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'immunization'){
		echo "immunization";

		$sql = "SELECT p.patientID as patID, p.fName AS pFName, p.lName AS pLName, i.date AS date, i.type AS type
				FROM immunization i, patient p
				WHERE i.patientID = p.patientID  ";
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date </td>".
				   		" <td>Type </td>";
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'medicaltest'){
		echo "tests";
		$sql = "SELECT p.patientID as patID, p.fName AS pFName, p.lName AS pLName, m.date AS date, m.type as type, m.testLocation AS testLocation, m.aDate AS aDate, m.result as result 
				FROM medicaltest m, patient p
				WHERE m.patientID = p.patientID  
				ORDER BY patID";
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>Date Made </td>".
				   		" <td>Type </td>".
				   		" <td>Test Location </td>".
				   		" <td>Appointment Date </td>".
				   		" <td>Result </td>"	;
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>".
				   		" <td>". $row["testLocation"]. "</td>".
				   		" <td>". $row["aDate"]. "</td>".
				   		" <td>". $row["result"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo"<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["date"]. "</td>".
				   		" <td>". $row["type"]. "</td>".
				   		" <td>". $row["testLocation"]. "</td>".
				   		" <td>". $row["aDate"]. "</td>".
				   		" <td>". $row["result"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else if ($value1 == 'visitation'){
		echo "visit";
		$sql = "SELECT p.patientID AS patID, p.fName AS pFName, p.lName AS pLName, v.dateTime AS dateT, v.reasonForVisit AS reason, v.diagnosis AS diagnosis, v.serviceType AS service
				FROM visitation v, patient p
				WHERE v.patientID = p.patientID 
				ORDER BY p.patientID"; 
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Patient ID: </td>".
				   		" <td>Patient Name: </td>".
				   		" <td>DateTime </td>".
				   		" <td>Reason </td>".
				   		" <td>Diagnosis </td>".
				   		" <td>Service </td>";
				   	echo "</tr>";
				    echo "<tr>"; 
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateT"]. "</td>".
				   		" <td>". $row["reason"]. "</td>".
				   		" <td>". $row["diagnosis"]. "</td>".
				   		" <td>". $row["service"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo "<td>". $row["patID"]."</td>".
				   		" <td>". $row["pFName"]." " .$row["pLName"]."</td>".
				   		" <td>". $row["dateT"]. "</td>".
				   		" <td>". $row["reason"]. "</td>".
				   		" <td>". $row["diagnosis"]. "</td>".
				   		" <td>". $row["service"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";
	}
	else 
		echo "NOPE";

}//end Submit1_1
else if( isset( $_POST['Submit2'] ) ) { 
	/////////////////update patient info

	$value17 = $_POST['fName2'];
	$value18 = $_POST['lName2'];
	$value19 = $_POST['info'];
	$value20 = $_POST['change'];
	echo "First Name: ". $value17. ".";
	echo "<br>";
	echo "Last Name: ". $value18. ".";
	echo "<br>";
	echo "What changing: ". $value19. ".";
	echo "<br>";
	echo "To This: ". $value20. ".";
	echo "<br>";

	if ($value18 == null AND $value17 != null){
		//dont have last name, have first name (15)
		//delete given first name 
		#$sql3 = "SELECT * FROM patient WHERE fName LIKE '%$value15%' ";
		$sql4 = "UPDATE patient 
			 SET $value19 = '$value20' 
				 WHERE  fName LIKE '%$value17%' ";
		$result4 = $conn -> query($sql4);

	}
	else if($value17 == null AND $value18 != null){
		//dont have first name, have last name (16)
		//delete given last name 
		#$sql3 = "SELECT * FROM patient WHERE lName LIKE '%$value16%' ";
		$sql4 = "UPDATE patient 
				 SET $value19 = '$value20' 
				 WHERE  lName LIKE '%$value18%' ";
		$result4 = $conn -> query($sql4);
	}
	else {
		echo "GO BACK AND ENTER A NAME TO DELETE"; 
	}
	$sql4_2 = "SELECT * FROM patient";
	$result4_2 = $conn -> query($sql4_2);
	$count = 1; 
	echo "<table border = '1'>";
	if($result4_2 -> num_rows > 0 ){
		while($row = $result4_2->fetch_assoc()) {
			if($count == 1){
				echo "<tr>";
			   	echo "<td>Patient ID2: </td>".
			   		" <td>Name: </td>".
			   		" <td>Sex: </td>".
			   		" <td>Date of Birth </td>".
			   		" <td>Address </td>".
			   		" <td>Phone Number: </td>".
			   		" <td>Insurance: </td>".
			   		" <td>Insurance Number: </td>".
			   		" <td>Insurance Primary: </td>"; 
			   	echo "</tr>";
			    echo "<tr>";
			   	echo "<td>". $row["patientID"]."</td>".
			   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
			   		" <td>". $row["sex"]. "</td>".
			   		" <td>". $row["DOB"]. "</td>".
			   		" <td>". $row["address"]. "</td>".
			   		" <td>". $row["phoneNo"]. "</td>".
			   		" <td>". $row["insuranceProvider"]. "</td>".
			   		" <td>". $row["insuranceNo"]. "</td>".
			   		" <td>". $row["insurancePrimary"]. "</td>"; 
			   	echo "</tr>";
			   	$count++;
		 	  }
		 	  else {
		 	  	echo "<tr>";
			   	echo "<td>". $row["patientID"]."</td>".
			   		" <td>". $row["fName"]." " .$row["lName"]."</td>".
			   		" <td>". $row["sex"]. "</td>".
			   		" <td>". $row["DOB"]. "</td>".
			   		" <td>". $row["address"]. "</td>".
			   		" <td>". $row["phoneNo"]. "</td>".
			   		" <td>". $row["insuranceProvider"]. "</td>".
			   		" <td>". $row["insuranceNo"]. "</td>".
			   		" <td>". $row["insurancePrimary"]. "</td>"; 
			   	echo "</tr>";
		 	  }
		   }
		}
	echo "</table>";

}// end Submit2 
else if( isset( $_POST['Submit3'] ) ) {

	$sql = "SELECT e.fName AS eFName, e.lName AS eLName, s.employeeID AS 	employeeID, s.workDays AS workDays, s.startTime AS 				startTime, s.endTime AS endTime
			FROM schedule s, employee e
			WHERE e.employeeID = s.employeeID"; 
	$result = $conn -> query($sql);
	$count = 1; 
	echo "<table border = '1'>";
	if($result -> num_rows > 0 ){
		while($row = $result->fetch_assoc()) {
			if($count == 1){
				echo "<tr>";
			   	echo "<td>EmployeeID: </td>".
			   		" <td>Name: </td>".
			   		" <td>Work Days: </td>".
			   		" <td>Start Time </td>".
			   		" <td>End Time </td>"; 
			   	echo "</tr>";
			    echo "<tr>";
			   	echo "<td>". $row["employeeID"]."</td>".
			   		" <td>". $row["eFName"]." " .$row["eLName"]."</td>".
			   		" <td>". $row["workDays"]. "</td>".
			   		" <td>". $row["startTime"]. "</td>".
			   		" <td>". $row["endTime"]. "</td>"; 
			   	echo "</tr>";
			   	$count++;
		 	  }
		 	  else {
		 	  	echo "<tr>";
			   	echo "<td>". $row["employeeID"]."</td>".
			   		" <td>". $row["eFName"]." " .$row["eLName"]."</td>".
			   		" <td>". $row["workDays"]. "</td>".
			   		" <td>". $row["startTime"]. "</td>".
			   		" <td>". $row["endTime"]. "</td>";  
			   	echo "</tr>";
		 	  }
		   }
		}
	echo "</table>";



}	//end Submit3 	
else if( isset( $_POST['Submit4'] ) ) {
		/////////////////see thier schedule for the day 
		$value1 = $_POST["doctorName"];
		echo "Patient Appts For the Day: ";
		if($value1 != null){
			$sql = "SELECT  e.fName AS eFName, e.lName AS eLName, a.dateTime AS dateTime, a.patientID AS patientID, e.employeeID AS employeeID, a.checkedIn AS checkedIn
					FROM appointment a, employee e 
					WHERE e.employeeID = $value1 AND a.employeeID =$value1";
			}
			else {
				$sql = "SELECT  e.fName AS eFName, e.lName AS eLName, a.dateTime AS dateTime, a.patientID AS patientID, e.employeeID AS employeeID, a.checkedIn AS checkedIn
					FROM appointment a, employee e
					WHERE e.employeeID = a.employeeID";
			}
		$result = $conn -> query($sql);
		$count = 1; 
		echo "<table border = '1'>";
		if($result -> num_rows > 0 ){
			while($row = $result->fetch_assoc()) {
				if($count == 1){
					echo "<tr>";
				   	echo "<td>Doctor Name: </td>".
				   		" <td>EmployeeID: </td>".
				   		" <td>Date: </td>".
				   		" <td>PatientID: </td>".
				   		" <td>Checked In?: </td>";
				   	echo "</tr>";
				    echo "<tr>";
				   	echo " <td>". $row["eFName"]." " .$row["eLName"]."</td>".
						" <td>". $row["employeeID"]."</td>".
				   		" <td>". $row["dateTime"]."</td>". 
				   		" <td>". $row["patientID"]. "</td>".
				   		" <td>". $row["checkedIn"]. "</td>";
				   	echo "</tr>";
				   	$count++;
			 	  }
			 	  else {
			 	  	echo "<tr>";
				   	echo" <td>". $row["eFName"]." " .$row["eLName"]."</td>".
						" <td>". $row["employeeID"]."</td>".
				   		" <td>". $row["dateTime"]."</td>". 
				   		" <td>". $row["patientID"]. "</td>".
				   		" <td>". $row["checkedIn"]. "</td>";
				   	echo "</tr>";
			 	  }
			   }
			}
		echo "</table>";

} //end Submit4 
else {
		echo "GOODBYE";
		}

		   	
?> 


</body>
<html> 
