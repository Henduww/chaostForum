
<?php
session_start();

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo 'This file cannot be called directly!';
} else {
	$sql = 'INSERT INTO reply(reply_content, reply_date, reply_topic, reply_by) VALUES("' . $_POST['message'] . '",NOW(),"' . mysqli_real_escape_string($conn, $_GET['id']) . '","' . $_SESSION['username'] . '")';

	$result = mysqli_query($conn, $sql);

	if (!$result) {
		echo 'Failed to insert reply into database. Error: ' . mysqli_error($conn);
	} else {
		header("Location: topic.php?id=" . $_GET['id']);
	}
}

?>