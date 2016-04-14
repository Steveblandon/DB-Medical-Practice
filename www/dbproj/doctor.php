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

/////////////////view patient info

/////////////////edit patient info
 
/////////////////see thier schedule for the day 
		   	
?> 


</body>
<html> 
