<head>

	<style>

	#content {
		text-align: center;
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

	echo '<h3>Create a topic</h3>';


	if ($_SERVER['REQUEST_METHOD'] != 'POST') {

		$sql = 'SELECT cat_id, cat_name, cat_description FROM categories';
		$result = mysqli_query($conn, $sql);

		if (!$result) {
			echo 'Categories could not be displayed!';
		} else {
			if (mysqli_num_rows($result) == 0) {
				echo 'No categories has been made yet.';
			} else {
				echo '
					<form method="post" action="">
						Subject: <input type="text" name="topic_sub" /><br><br>
						Category:

						<select name="topic_cat">';
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
							}
						echo '</select><br><br>
						Message:<br> <textarea name="post_cont" placeholder="Make the first post on this topic.."></textarea><br><br>
						<input type="submit" value="Create Topic" />
					</form>
				';
			}
		}

	} else {
		$query = 'BEGIN WORK;';
		$result = mysqli_query($conn, $query);

		if (!$result) {
			echo 'An error occured while trying to create your topic, please try again later.';
		} else {
			$sql = 'INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_by) VALUES("' . mysqli_real_escape_string($conn, $_POST['topic_sub']) . '",NOW(),"' . mysqli_real_escape_string($conn, $_POST['topic_cat']) . '","' . $_SESSION['username'] . '")';

			$result = mysqli_query($conn, $sql);

			if (!$result) {
				echo 'Something went wrong while inserting your topic into the database. Error: ' . mysqli_error($conn);

				$query = 'ROLLBACK;';
				$result = mysqli_query($conn, $query);
			} else {
				$topicid = mysqli_insert_id($conn);

				$sql = 'INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES("' . mysqli_real_escape_string($conn, $_POST['post_cont']) . '",NOW(),"' . $topicid . '","' . $_SESSION['username'] . '")';

				$result = mysqli_query($conn, $sql);

				if (!$result) {
					echo 'An error occured when trying to insert your post into the database. Error: ' . mysqli_error($conn);

					$query = 'ROLLBACK;';
					$result = mysqli_query($conn, $query);
				} else {
					$sql = 'COMMIT;';
					$result = mysqli_query($conn, $sql);

					echo 'You have successfully created <a href="topic.php?id=' . $topicid . '">a new topic.</a>';
				}
			}
		}
	}


	include 'footer.php';

?>