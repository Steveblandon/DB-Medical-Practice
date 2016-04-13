<html> 
<body> 
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


$value1 = $_POST["name"];
//view patient info 
$sql = "SELECT * FROM patient";
$sql = "SELECT * FROM patient WHERE fName LIKE'%$value1%' OR lName LIKE'%$value1%' ";
$result = $conn -> query($sql);
if($result -> num_rows > 0 ){
while($row = $result->fetch_assoc()) {
   	echo "Patient ID: " . $row["patientID"]. "<br>".
   		" Name : " . $row["fName"]." " .$row["lName"]. "<br>".
   		" Sex: " . $row["sex"]. "<br>".
   		" Date of Birth " . $row["DOB"]. "<br>".
   		" Address " . $row["address"]. "<br>".
   		" Phone Number: " . $row["phoneNo"]. "<br>".
   		" Insurance: " . $row["insuranceProvider"]. "<br>".
   		" Insurance Number: " . $row["insuranceNo"]. "<br>".
   		" Insurance Primary: " . $row["insurancePrimary"]. "<br>"; 
   }
}


//update patient info 
//what to update? 
// to how much? 
//who 
$value2 = $_POST["changingName"];
$value3 = $_POST["category"];
$value4 = $_POST["change"];
echo $value2."    " .$value3. " " .$value4. "<br>";
$sql2 = "UPDATE patient 
		 SET $value3 = $value4 
		 WHERE lName ='Robertino' ";
		 
$sql4 = "UPDATE department 
		SET budget = budget*1.05 
		WHERE deptName = 'Biology' ";

if($conn -> query($sql2) == TRUE ){
	echo "<br/>";
	echo "Insertion Successfull";

	$sql3 = "SELECT * FROM patient WHERE fName LIKE '%$value2%' OR lName LIKE '%$value2%' ";
	$result3 = $conn -> query($sql3);
	while($row = $result3->fetch_assoc()) {
 		   	echo "Patient ID2: " . $row["patientID"]. "<br>".
		   		" Name : " . $row["fName"]." " .$row["lName"]. "<br>".
		   		" Sex: " . $row["sex"]. "<br>".
		   		" Date of Birth " . $row["DOB"]. "<br>".
		   		" Address " . $row["address"]. "<br>".
		   		" Phone Number: " . $row["phoneNo"]. "<br>".
		   		" Insurance: " . $row["insuranceProvider"]. "<br>".
		   		" Insurance Number: " . $row["insuranceNo"]. "<br>".
		   		" Insurance Primary: " . $row["insurancePrimary"]. "<br>"; 
		  }
	}
else {
	echo "<br/>";
	echo "Error: " . $conn -> error; 
}

?> 


</body>
<html> 
