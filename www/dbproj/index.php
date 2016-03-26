<html>
<body>
<?php
$serverName = "localhost";
$username = "root";
$password = "";
$database = "dbproj";

$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}
else echo "Connected to database successfully <br>";
?>
</body>
</html>