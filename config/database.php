<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "tripzfp3_bookingengine";
			$password = "admin@3214";
			$dbname = "tripzfp3_bookingengine";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
?>