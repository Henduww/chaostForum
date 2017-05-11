<head>

	<style>

		table, th, td {
			border: 1px solid white;
		}

		table {
			margin: auto;
			border-collapse: collapse;
		}

		td {
			text-align: center;
			padding: 12px 16px;
			background-color: #cc0000;
			color: white;
		}

		th {
			padding: 12px 16px;
			background-color: #cc0000;
			color: white;
			border: none;
		}

		td:hover {
			background-color: #e60000;
		}

		table a:link, table a:visited {
			text-decoration: none;
			color: white;
		}

		#catName {
			text-align: center;
			margin-bottom: 15px;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	if (!isset($_GET['id'])) {

		$sql = 'SELECT DISTINCT * FROM topics INNER JOIN categories ON topics.topic_cat = categories.cat_id ORDER BY topics.topic_date DESC LIMIT 6';

		$result = mysqli_query($conn, $sql);

		if (!$result) {
			echo 'Could not display categories.';
		} else {
			if (mysqli_num_rows($result) == 0) {
				echo 'No categories found in the database.';
			} else {
				echo '
				<div id="allCats">
					<table>
						<tr>
							<th>Category</th>
							<th>Latest Topic</th>
						</tr>
					';

					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr>
					         <td class="leftpart">
				                <h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'] . '
			                </td>
			                <td class="rightpart">
			                    <a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '<br>By <b>' . $row['topic_by'] . '</b></a>
			                </td>
			            </tr>
			            ';
					}

				echo '</table>
				</div>
				';
			}
		}
	} elseif ($_GET['id'] == ""){
		echo 'INVALID, please click the "Categories" link on the navigation bar to refresh!';
	} else {
		$sql = 'SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id=' . mysqli_real_escape_string($conn, $_GET['id']);

		$result = mysqli_query($conn, $sql);

		if (!$result) {
			echo 'Could not retrieve the selected category. Error: ' . mysqli_error($conn);
		} else {
			if (mysqli_num_rows($result) == 0) {
				echo 'This category does not exist.';
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<h2 id="catName">' . $row['cat_name'] . '</h2>';
				}

				$sql = 'SELECT topic_id, topic_subject, topic_date, topic_cat, topic_by FROM topics WHERE topic_cat=' . mysqli_real_escape_string($conn, $_GET['id']);

				$result = mysqli_query($conn, $sql);

				if (!$result) {
					echo 'Failed to display topics. Error: ' . mysqli_error($conn);
				} else {
					if (mysqli_num_rows($result) == 0) {
						echo 'There are no topics in this category yet.';
					} else {
						echo '
							<table>
							<tr>
								<th>Topic</th>
								<th>Created at</th>
								<th>Created by</th>
							</tr>
						';
						while ($row = mysqli_fetch_assoc($result)) {
							echo '
								<tr>
									<td class="leftpart"><h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a></h3></td>
									<td class="middlepart">' . date('d-m-y', strtotime($row['topic_date'])) . '</td>
									<td class="rightpart">' . $row['topic_by'] . '</td>
								</tr>
							';
						}
						echo '</table>';
					}
				}
			}

		}
	}

	include 'footer.php';

?>