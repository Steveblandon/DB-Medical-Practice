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
	echo "";
} 

if( isset( $_POST['Submit1'] ) ) { 
	$value1 = $_POST["name"];
	//////////////////////view patient info ////////////////////////////////
	$sql = "SELECT * FROM patient WHERE fName LIKE '%$value1%' OR lName LIKE '%$value1%' ";
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
} //end patient info 
else if( isset( $_POST['Submit2'] ) ) { 
	//update patient info ////////////////////////////////////////////////
	$value2 = $_POST["changingName"];
	$value3 = $_POST["category"];
	$value4 = $_POST["change"];
	//echo "VALUES: ".$value2."    " .$value3. " " .$value4. "<br>";

	$sql2 = "UPDATE patient 
			 SET $value3 = '$value4' 
			 WHERE lName LIKE '%$value2%'
			 OR fName LIKE '%$value2%'
			 "; 

	if($conn -> query($sql2) == TRUE ){
		echo "<br/>";
		//echo "Insertion Successfull <br><br>";
		echo "After Update: <br>";
		$sql3 = "SELECT * 
				 FROM patient 
				 WHERE fName LIKE '%$value2%' OR lName LIKE '%$value2%' ";
		$result3 = $conn -> query($sql3);
		echo "<table border = '1'>";
		while($row = $result3->fetch_assoc()) {		
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
			   		" <td>". $row["address"]. "</td>".
			   		" <td>". $row["phoneNo"]. "</td>".
			   		" <td>". $row["insuranceProvider"]. "</td>".
			   		" <td>". $row["insuranceNo"]. "</td>".
			   		" <td>". $row["insurancePrimary"]. "</td>"; 
			   	echo "</tr>";
			  }
		}
	else {
		echo "<br/>";
		echo "Error: " . $conn -> error; 
	}
	echo "</table>";
}//end update 


?> 


</body>
<html> 
