<head>

	<style>

		#content {
			text-align: center;
		}

		#addruleHeader {
			background-color: #cc0000;
			height: 30px;
			text-align: center;
			color: white;
			margin-bottom: 25px;
		}

		#addruleHeader h2 {
			padding: 2px;
		}

		#addRule {
			width: 600px;
			height: 35px;
			resize: none;
		}

		#submit {
			color: white;
			background-color: #cc0000;
			padding: 5px 15px;
			border: 1px solid rgb(227, 227, 227);
			border-radius: 5px;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '
	<div id="addruleHeader">
		<h2>Add Rule</h2>
	</div>';

	if ($_SESSION['userlvl'] != '1') {
		echo 'You do not have permission to add a new rule.';
	} else {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			echo '
			<div id="newRule">
				<form action="" method="post">
					<textarea name="newRule" placeholder="Make a new rule.. (Do not include points as these are automatically added.)" id="addRule"></textarea><br><br>
					<input id="submit" type="submit" value="Add Rule" />
				</form>
			</div>';
		} else {
			if (!ctype_alnum($_POST['newRule'])) {
				echo 'Rules can only contain letters.';
			} else {
				$sql = 'INSERT INTO rules(rule_content) VALUES("' . mysqli_real_escape_string($conn, $_POST['newRule']) . '")';
				$result = mysqli_query($conn, $sql);

				if (!$result) {
					echo 'Failed to add new rule! Error: ' . mysqli_error($conn);
				} else {
					echo 'New rule added successfully. <a href="rules">Go there.</a>';
				}
			} //only letters
		} //after post
	} //userlevel

	include 'footer.php';

?>