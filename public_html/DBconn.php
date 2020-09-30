<?php
function connect()
{
	$servername = "s75.linuxpl.com";
	$username = "rkkrzy_root";
	$password = "W10loncz3l@";
	$dbName = "rkkrzy_IiE";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	$conn->set_charset("utf8");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return($conn);
}
	
function disconnect($connection)
{
	$connection -> close();
}
?>