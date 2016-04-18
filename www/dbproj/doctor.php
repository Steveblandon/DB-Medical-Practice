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

if ( isset( $_POST['Submit1'] ) ) { 
	/////////////////view patient info
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
		}
else if( isset( $_POST['Submit2'] ) ) { 
	/////////////////edit patient info

		echo "yo";
		}
else if( isset( $_POST['Submit3'] ) ) {
		/////////////////see thier schedule for the day 
		}
else {
		echo "GOODBYE";
		}

		   	
?> 


</body>
<html> 
