<html> 
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script>
		//ignore this function for now, just experimenting
		function editTable(element)
		{
			htm = element.innerHTML;
			element.innerHTML = "<input type='text' value='" + htm + "'>";
		}
	</script>
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
?>

<navbar>
<div class="container">
	<div class="row">
		<div class="col-md-9"></div>
		<div class="col-md-3">
			<button class="btn btn-default" style="margin-top:5px;">log out</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#Home">Home</a></li> 
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Patients
			<span class="caret"></span></a>
				<ul class="dropdown-menu">
				<li><a data-toggle="tab" href="#ViewPatient">Search</a></li>
				<li><a data-toggle="tab" href="#AddPatient">Add New Patient</a></li>
				<li><a data-toggle="tab" href="#DelPatient">Delete Patient</a></li>
				<li><a data-toggle="tab" href="#UpdatePatient">Update Patient</a></li>
				</ul>
			</li>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="tab-content">
				<div id="Home" class="tab-pane fade in active">
				<?php 
				if( isset( $_POST['Submit1'] ) ) { 
					echo ""; 
				}
				else if( isset( $_POST['Submit2'] ) ) { 
					echo "<h1 class='text-center'> Added Succesfully"; 
				}
				else if( isset( $_POST['Submit3'] ) ) { 
					echo ""; 
				}
				else if( isset( $_POST['Submit4'] ) ) { 
					echo ""; 
				}
				else {
					echo "<h1 class='text-center'> Welcome! </h1>
					<p class='text-center'> Nurse suite </p>";
				}

				?>
					
				</div>
				<?php 
				if( isset( $_POST['Submit1'] ) ) { 
					echo "<div id='ViewPatient' class='tab-pane fade in active'>";
				}
				else 
					echo "<div id='ViewPatient' class='tab-pane fade'>";
				?> 
					<p> View patient 
					<form action = 'nurse.php' method = 'post'>
					Patient to seach for: <input type = "text" name = "name"> <br>
					<input type = 'submit' value = 'Search for Patient' name = 'Submit1'>
					<br> 
					<?php
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
					 //end patient info 
					}
					?>
					</p>
				</div>
				<?php 
				if( isset( $_POST['Submit2'] ) ) { 
					echo "<div id='AddPatient' class='tab-pane fade in active'>";
				}
				else 
					echo "<div id='AddPatient' class='tab-pane fade'>";
				?> 
					<p> Add Patient <br>
					<form action = 'nurse.php' method = 'post'>
					ID: <input type = "text" name = "ID"> <br>
					First Name: <input type = "text" name = "fName1"> <br>
					Last Name: <input type = "text" name = "lName1"> <br>
					Sex: <input type = "text" name = "sex"> <br>
					DOB: <input type = "text" name = "DOB" placeholder="YYYY-MM-DD"> <br>
					Address: <input type = "text" name = "address"> <br>
					Phone Number: <input type = "text" name = "phoneNo"> <br>
					Insurance Provider: <input type = "text" name = "insurancePro"> <br>
					Insurance Number: <input type = "text" name = "insuranceNo"> <br>
					Insurance Primary: <input type = "text" name = "insurancePrim"> <br>	
					<input type = 'submit' value = 'Add Patient' name = 'Submit2'>
					<?php 
					if( isset( $_POST['Submit2'] ) ) { 
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
					?>

					</p>
				</div>
				<?php 
				if( isset( $_POST['Submit3'] ) ) { 
					echo "<div id='DelPatient' class='tab-pane fade in active'>";
				}
				else 
					echo "<div id='DelPatient' class='tab-pane fade'>";
				?>
					<p> Delete Patient <br>
					<form action = 'nurse.php' method = 'post'>
					First Name: <input type = "text" name = "fName2"> <br>
					Last Name: <input type = "text" name = "lName2"> <br> 
					<input type = 'submit' value = 'Delete Patient' name = 'Submit3'>
					<?php
					 if( isset( $_POST['Submit3'] ) ) { 
						//Delete patient info ////////////////////////////////////////////////
						$value15 = $_POST["fName2"];
						$value16 = $_POST["lName2"];

						if ($value16 == null AND $value15 != null){
							//dont have last name, have first name (15)
							//delete given first name 
							#$sql3 = "SELECT * FROM patient WHERE fName LIKE '%$value15%' ";
							echo "<br>Deleted person with First Name: ". $value15. ".";
							$sql3 = "DELETE FROM `patient` WHERE  fName LIKE '%$value15%' ";
							$result3 = $conn -> query($sql3);

						}
						else if($value15 == null AND $value16 != null){
							//dont have first name, have last name (16)
							//delete given last name 
							#$sql3 = "SELECT * FROM patient WHERE lName LIKE '%$value16%' ";
							echo "<br>Deleted person with Last Name: ". $value16. ".";
							$sql3 = "DELETE FROM `patient` WHERE  lName LIKE '%$value16%' ";
							$result3 = $conn -> query($sql3);
						}
						else if($value15 != null AND $value16 !=null){
							//has both first and last name 
							echo "<br>Deleted person with <br>First Name: ". $value15. "<br>Last Name: ". $value16;
							$sql3 = "DELETE FROM `patient` WHERE  lName LIKE '%$value16%' AND fName LIKE '%$value15%' ";
							$result3 = $conn -> query($sql3);
						}
						else {
							echo "<br>ENTER A NAME TO DELETE"; 
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
					}#//end Submit3 
					?>
					</p>
				</div>
				<?php 
				if( isset( $_POST['Submit4'] ) ) { 
					echo "<div id='UpdatePatient' class='tab-pane fade in active'>";
				}
				else 
					echo "<div id='UpdatePatient' class='tab-pane fade'>";
				?>
					<p> Update Patient 
					<form action = 'nurse.php' method = 'post'>
					Name to update: <br>
					First: <input type = "text" name = "fName3"> <br>
					Last Name: <input type = "text" name = "lName3"> <br> 
					What to update? <br>
					<input type="radio" name="info" value="fName"> First Name<br>
  					<input type="radio" name="info" value="lName"> Last Name<br>
 					<input type="radio" name="info" value="sex"> Sex <br>
 					<input type="radio" name="info" value="DOB"> DOB <br>
 					<input type="radio" name="info" value="address" checked> Address <br>
 					<input type="radio" name="info" value="phoneNo"> Phone Number <br>
 					<input type="radio" name="info" value="insuranceProvider"> Insurance Provider <br>
 					<input type="radio" name="info" value="insuranceNo"> Insurance Number <br>
 					<input type="radio" name="info" value="InsurancePrimary"> Insurance Primary <br>

					New Information: <input type = "text" name = "change"> <br> 
					<input type = 'submit' value = 'Update Patient' name = 'Submit4'>
					<?php
						if( isset( $_POST['Submit4'] ) ) { 
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
								$sql4 = "UPDATE patient 
									 SET $value19 = '$value20' 
										 WHERE  fName LIKE '%$value17%' ";
								$result4 = $conn -> query($sql4);

							}
							else if($value17 == null AND $value18 != null){
								//dont have first name, have last name (16)
								//delete given last name 
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
					}//end Submit4
				?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	
</div>
<navbar>
<?php 









?> 
</body>
<html> 
