<?php
require "dbConnect.php";

try{
	echo $_SESSION["user"];
}catch(Exception $err){
	echo "";
}
?>