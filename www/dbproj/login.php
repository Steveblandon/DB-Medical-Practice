<html> 
<body> 
<?php 

require "dbConnect.php";

$username = $_POST["username"];
$password = $_POST["password"]; 

echo "Value1: ".$username;
echo "<br>Value2: ". $password; 

$sql = "SELECT * FROM account WHERE username='$username' and password='$password' "; 
$result = $conn->query($sql);
if($result -> num_rows > 0 ){
	echo "<br> Done";
}
else {
	echo "<br>not";
}



?> 
</body>
</html> 