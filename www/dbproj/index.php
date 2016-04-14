<html>

<body>
<?php
//http://127.0.0.1/dbproj2/index.php <--- web address 
	$serverName = "localhost"; 
	$username = "root";
	$password = "";
	$dbname = "hospitalDB";

	$conn = new mysqli($serverName, $username, $password, $dbname);

	if($conn -> connect_error) {
		die ("Connection Failed: " . $conn -> connect_error);
	}
	else{
		echo "Database Accessed successfully <br>";
	}


	//drop down menu 
	echo 'Select Course ID <br>';
	$query = mysqli_query($conn,"SELECT courseID,title FROM course"); 
	echo '<select name="CourseTitles">'; 
	echo '<option value="">Select</option>'; 
	    while($row = $query->fetch_assoc()) {
	   echo '<option value="'.$row["title"].'">'.$row["title"].'</option>';
	}
	echo '</select>';
	echo '<br>';
	$course = "";

?>
Name: <input type="text" name="name" value="<?php echo $course;?>">
<?php
/*
	//search box 
	echo 'What do you want to look up? <br>';
	echo '<form method="post"> 
			Look Up: <br> 
			<input type="text" name ="' .$courseID. '">
			 </form>';  
			 
	//$query = mysqli_query($conn,"SELECT" .$courseID. "FROM course"); 
	$sql = "SELECT $course FROM course";
	$result = $conn -> query($sql);
	$query2 = mysqli_query($conn,"SELECT course FROM course WHERE courseID =" $course""); 
	if ($result -> num_rows > 0) {
   		while($row = $result -> fetch_assoc() ) {
	 		echo $row[$course];
	 	}
	 }
	else {
    	echo "0 results";
	}


*/ 
	$conn->close(); 
?>
</body>
</html>