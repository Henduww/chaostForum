<head>

	<style>

		#promoteHeader {
			background-color: #cc0000;
			width: 95%;
			height: 80px;
			text-align: center;
			color: white;
		}

		#noPermission {
			margin: auto;
			text-align: center;
		}

		#underTxt {
			color: #595959;
		}

		#mainForm {
			margin: auto;
		}

		.failed {
			margin: auto;
			color: red;
		}

		.success {
			margin: auto;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '<div id="promoteHeader><h2>Promote member</h2></div>"';

	if ($_SESSION['userlvl'] != '1') {
		echo '<div id="noPermission"><h2>You do not have permission to promote a member!</h2><br><h4 id="underTxt">If this is wrong, please contact your web developer.</h4></div>';
	} else {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {

			$sql = 'SELECT user_name, user_id FROM users WHERE user_level=0';
			$reuslt = mysqli_query($conn, $sql);

			if (!$result) {
				echo '<h3 class="failed">Could not display users!</h3>';
			} else {
				echo '
				<div id="mainForm">
					<form method="post" action="">
						<select name="user">';
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . $row['user_id'] . '">' . $row['user_name'] . '</option>';
						}
						echo '
						</select><br>
						<input type="submit" value="Promote">
					</form>
				</div>
				';
			} //result success
		} else /*REQ_METHOD*/ {
			$sql = 'UPDATE users SET user_level="1" WHERE user_id=' . $_POST['user'];
			$result = mysqli_query($conn, $sql);

			if (!$result) {
				echo '<h3 class="failed">Failed to promote user.</h3>';
			} else {
				echo '<h3 class="success">User was successfully promoted.</h3>';
			}
		} //afterpost
	} //usrlvl

	include 'footer.php';

?>