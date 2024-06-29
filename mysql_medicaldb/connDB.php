<?php 
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$dbName = 'mysql_medicaldb';
	$conn = new mysqli($server,$username,$password,$dbName);
		
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error)	;
	} else {
		mysqli_set_charset($conn, 'utf8');
	}
?>
