<?php
	
	$dbserver = "localhost";
	$dbusername = "id1203972_tumi";
	$dbpassword = "forumpass";
	$db_name = "id1203972_forum";

	$conn = mysqli_connect($dbserver, $dbusername, $dbpassword, $db_name);

	if ($conn->connect_error) {
		die("Connection to database failed: " . $conn->connect_error);
	}

?>