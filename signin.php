<head>

	<style>

		#content {
			text-align: center;
		}

		#signInForm, #signInDirs, form {
			display: inline-table;
		}

		#signInDirs {
			border-right: 1px solid gray;
		}

		.dir {
			margin-bottom: 6px;
			margin-right: 5px;
		}

		h3 {
			margin-right: 0px;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '<h3>Sign In</h3>';

	if (isset($_SESSION['signedIn'])) {
		echo '<p class="error">You are already signed in!</p>';
	} else {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			echo '
				<div id="signInDirs">
					<p class="dir">Username</p>
					<p class="dir">Password</p>
				</div>
				<div id="signInForm">
				<form method="post" action="">
					<input type="text" name="username" /><br>
					<input type="password" name="password" /><br><br>
					<input type="submit" value="Sign In" />
				</form>
				</div>
			';
		} else {
			$errors = array();

			if ($_POST['username'] == "") {
				$errors[] = 'The username field cannot be empty!';
			}

			if ($_POST['password'] == "") {
				$errors[] = 'The password field cannot be empty!';
			}

			if (!empty($errors)) {
				echo '<p class="error">Something went wrong..</p>';
				echo '<ul class="error">';
				foreach ($errors as $key => $value) {
					echo '<li>' . $value . '</li>';
				}
				echo '</ul>';
			} else {
				$sql = 'SELECT user_id, user_name, user_level FROM users WHERE user_name="' . mysqli_real_escape_string($conn, $_POST["username"]) . '" AND user_pass="' . sha1($_POST["password"]) . '"';

				$result = mysqli_query($conn, $sql);

				if (!$result) {
					echo 'Something went wrong while trying to sign you in, please try again later.';
					//echo mysqli_error();
				} else {
					if (mysqli_num_rows($result) == 0) {
						echo '<p id="falseCreds">Could not find your login information in the database.</p>';
					} else {
						$_SESSION['signedIn'] = TRUE;

						while ($row = $result->fetch_assoc()) {
							$_SESSION['userid'] = $row['user_id'];
							$_SESSION['username'] = $row['user_name'];
							$_SESSION['userlvl'] = $row['user_level'];
						}

						echo '<p id="signInSuccess">Welcome, ' . $_SESSION['username'] . '! Please <a href="index.php">click here</a> to proceed..</p>';
					}
				}
			}
		}
	}

	include 'footer.php';

?>