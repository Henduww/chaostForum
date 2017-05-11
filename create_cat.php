<head>

	<style>

		#content {
			text-align: center;
		}

		#createCatForm, #catDirs, form {
			display: inline-table;
		}

		#catDirs {
			border-right: 1px solid gray;
		}

		.dir {
			margin-bottom: 25px;
			margin-right: 5px;
		}

		h3 {
			margin-right: 0px;
		}

		textarea {
			width: 365px;
			height: 130px;
			resize: none;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '<h3>Create a Category</h3>';

	if ($_SESSION['userlvl'] != "1") {
		echo '<p class="error">You do not have permission to create a new category.</p>';
	} else {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			echo '
			<div id="catDirs">
				<p class="dir">Category Name</p>
				<p class="dir">Category Description</p>
			</div>
			<div id="createCatForm">
				<form method="post" action="">
					<input type="text" name="catName" /><br><br>
					<textarea name="catDesc" placeholder="Enter some information about the category here.."></textarea><br><br>
					<input type="submit" value="Create Category" />
				</form>
			</div>
			';
		} else {
			$errors = array();

			if ($_POST['catName'] == "") {
				$errors[] = '<p class="error">Category name cannot be empty!';
			}

			if ($_POST['catDesc'] == "") {
				$errors[] = '<p class="error">Category description cannot be empty!';
			}

			if (!empty($errors)) {
				echo '<p class="error">Something went wrong..</p>';
				echo '<ul class="error">';
				foreach ($errors as $key => $value) {
					echo '<li>' . $value . '</li>';
				}
				echo '</ul>';
			} else {
				$sql = 'INSERT INTO categories(cat_name, cat_description) VALUES("' . mysqli_real_escape_string($conn, $_POST['catName']) . '", "' . mysqli_real_escape_string($conn, $_POST['catDesc']) . '")';

				$result = mysqli_query($conn, $sql);

				if (!$result) {
					echo '<p class="error">Something went wrong while trying to make the category, please contact you webdeveloper. Error: ' . mysqli_error() . '</p>';
				} else {
					echo '
					<p class="success">New category successfully added.</p><br>
					<a href="create_cat.php">Go back</a>
					';
				}
			}
		}
	}

	include 'footer.php';

?>