<head>

	<style>

		#content {
			text-align: center;
		}

		#signUpForm, #signUpDirs, form {
			display: inline-table;
		}

		#signUpDirs {
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

	echo '<h3>Sign Up</h3>';

	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		echo '
			<div id="signUpDirs">
				<p class="dir">Username</p>
				<p class="dir">Password</p>
				<p class="dir">Repeat Password</p>
				<p class="dir">E-Mail*</p>
			</diV>
			<div id="signUpForm">
				<form method="post" action="">
					<input type="text" name="username" /><br>
					<input type="password" name="password" /><br>
					<input type="password" name="pass_check" /><br>
					<input type="text" name="user_email" /><br><br>
					<input type="submit" value="Sign Up" />
				</form>
			</div>
		';
	} else {
		$errors = array();

		if ($_POST['username'] != '') {
			if (!ctype_alnum($_POST['username'])) {
				$errors[] = 'The username can only contain letters and digits.';
			}
			if (strlen($_POST['username']) > 30) {
				$errors[] = 'The username can not be longer than 30 characters.';
			}
		} else {
			$errors[] = 'The username field can not be empty.';
		}

		if ($_POST['password'] != "") {
			if ($_POST['password'] != $_POST['pass_check']) {
				$errors[] = 'The two passwords did not match.';
			}
		} else {
			$errors[] = 'The password field can not be empty.';
		}

		if (!empty($errors)) {
			echo '<p class="error">A couple of fields were not filled in correctly...</p>';
			echo '<ul class="error">';
			foreach($errors as $key => $value) {
				echo '<li>' . $value . '</li>';
			}
			echo '</ul>';
			
		} else {
			$sql = 'INSERT INTO users(user_name, user_pass, user_email, user_date, user_level) VALUES("' . mysqli_real_escape_string($conn, $_POST['username']) . '", "' . sha1($_POST['password']) . '", "' . mysqli_real_escape_string($conn, $_POST['user_email']) . '", NOW(), 0)';

			$result = mysqli_query($conn, $sql);

			if (!$result) {
				echo 'Something went wrong.. Please try again later.';
				//echo mysqli_error();
			} else {
				echo '<p id="signUpSuccess">Successfully registered, you can now <a href="signin.php">sign in</a> and start posting.</p>';
			}
		}
	}

	echo '<br><p id="emailNote">*If you do not include an e-mail you will not be able to reset your password.</p>';

	include 'footer.php';

?>