<html> 
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
	////////////////////add patient //////////////////////////////////////
	$value5 = $_POST["ID"];
	$value6 = $_POST["fName1"];
	$value7 = $_POST["lName1"];
	$value8 = $_POST["sex"];
	$value9 = $_POST["DOB"];
	$value10 = $_POST["address"];
	$value11 = $_POST["phoneNo"];
	$value12 = $_POST["insurancePro"];
	$value13 = $_POST["insuranceNo"];
	$value14 = $_POST["insurancePrim"];
	echo "First Name: ". $value6; 
	echo "Last Name: ". $value7; 
	$sql2 = "INSERT INTO `patient`(`patientID`, `fName`, `lName`, `sex`, `DOB`, `address`, `phoneNo`, `insuranceProvider`, `insuranceNo`, `insurancePrimary`) VALUES ('$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11', '$value12', '$value13', '$value14')";
	$result2 = $conn -> query($sql2);
	$sql22 = "SELECT * FROM patient";
	$result22 = $conn -> query($sql22);

	$count = 1; 
	echo "<table border = '1'>";
	if($result22 -> num_rows > 0 ){
		while($row = $result22->fetch_assoc()) {
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
} //end Submit2 
else if( isset( $_POST['Submit3'] ) ) { 
	//Delte patient info ////////////////////////////////////////////////
	$value15 = $_POST["fName2"];
	$value16 = $_POST["lName2"];
	echo "First Name: ". $value15. ".";
	echo "<br>";
	echo "Last Name: ". $value16. ".";
	echo "<br>";
	if ($value16 == null AND $value15 != null){
		//dont have last name, have first name (15)
		//delete given first name 
		#$sql3 = "SELECT * FROM patient WHERE fName LIKE '%$value15%' ";
		$sql3 = "DELETE FROM `patient` WHERE  fName LIKE '%$value15%' ";
		$result3 = $conn -> query($sql3);

	}
	else if($value15 == null AND $value16 != null){
		//dont have first name, have last name (16)
		//delete given last name 
		#$sql3 = "SELECT * FROM patient WHERE lName LIKE '%$value16%' ";
		$sql3 = "DELETE FROM `patient` WHERE  lName LIKE '%$value16%' ";
		$result3 = $conn -> query($sql3);
	}
	else {
		echo "GO BACK AND ENTER A NAME TO DELETE"; 
	}
	
	$sql3_2 = "SELECT * FROM patient";
	$result3_2 = $conn -> query($sql3_2);
	$count = 1; 
	echo "<table border = '1'>";
	if($result3_2 -> num_rows > 0 ){
		while($row = $result3_2->fetch_assoc()) {
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
}//end Submit3 

else if( isset( $_POST['Submit4'] ) ) { 
	//Update Patient iNfo//////////////////////////////////////////////
	$value17 = $_POST['fName3'];
	$value18 = $_POST['lName3'];
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
	#$sql4 = "UPDATE patient 
	#		 SET $value19 = '$value20' 
	#		 WHERE lName LIKE '%$value18%' OR fName LIKE '%$value17%'
	#		 "; 
	#$result4 = $conn -> query($sql4);
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


}//end Submit4
else {
			echo "Nothing Happened ---- Hit the Back Button";

}





?> 
</body>
<html> 
