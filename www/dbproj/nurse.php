<html> 
<body> 

Nurse Stuff <br> 
-view and update patient info  <br> 

<?php 

//connect to database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitaldb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{	
	echo "Successfully connected <br>";
} 

//view patient info 
$sql = "SELECT * FROM patient";
$result = $conn -> query($sql);
if($result -> num_rows > 0 ){
while($row = $result->fetch_assoc()) {
   	echo "Patient ID: " . $row["patientID"].
   		" Name : " . $row["fName"]." " .$row["lName"].
   		" Sex: " . $row["sex"].
   		" Date of Birth " . $row["DOB"].
   		" Address " . $row["address"].
   		" Phone Number: " . $row["phoneNo"].
   		" Insurance: " . $row["insuranceProvider"].
   		" Insurance Number: " . $row["insuranceNo"].
   		" Insurance Primary: " . $row["insurancePrimary"]. "<br>"; 
   }
}


?> 


</body>
<html> 
