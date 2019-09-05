<?php
	$servername = "localhost";	$username = "root"; $password = "YL13H!";
	// Create connection
	$conn = @mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
		die("Connection Failed: " . mysqli_connect_error().'<br/>');
	} else 	{
		echo "Connection Succesfull".'<br/>';
	}	
	// Check database
	if(!@mysqli_select_db($conn, 'mysql')) 	{
		die('Failed to connect to the Database: ' . mysqli_error($link));
	} else 	{
		echo "Database Connected";
	}
?>
