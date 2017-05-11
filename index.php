<head>

	<style>

		#headLogo {
			text-align: center;
			padding: 5px;
			border-bottom: 1px solid lightgray;
		}

		#cs {
			width: 835px;
			border-bottom: 1px solid lightgray;
			padding-bottom: 20px;
		}

		#cats {
			margin: auto;
			margin-top: 30px;
			width: 600px;
			padding-bottom: 20px;
		}

		#cats a:link, #cats a:visited {
			text-decoration: none;
			color: white;
		}

		#sampleTxt {
			border-top: 1px solid lightgray;
			padding-top: 20px;
			text-align: center;
			width: 60%;
			word-wrap: break-word;
			margin: auto;
		}

		#sampleTxt p {
			color: #595959;
		}

		table, th, td {
			border: 1px solid white;
		}

		table {
			margin: auto;
			border-collapse: collapse;
		}

		td {
			padding: 12px 16px;
			text-align: center;
			background-color: #cc0000;
			color: white;
		}

		td:hover {
			background-color: #e60000;
		}

		th {
			background-color: #cc0000;
			color: white;
			padding: 12px 16px;
			border: 0px;
		}

		h3 {
			text-align: center;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

?>

<div id="headLogo">
	<h2>Chaost Forum</h2>
</div>
<br>
<div id="picCont">
	<img id="cs" src="csgobanner.jpg" alt="Banner Image">
</div>
<div id="cats">
	<?php
		$sql = '
		SELECT DISTINCT topics.topic_id, topics.topic_subject, topics.topic_by, categories.cat_id, categories.cat_name, categories.cat_description FROM topics JOIN categories ON topics.topic_cat = categories.cat_id ORDER BY topics.topic_date DESC LIMIT 3
		';

		$result = mysqli_query($conn, $sql);

		if (!$result) {
			echo 'Could not display categories. Error: ' . mysqli_error($conn);
		} else {
			if (mysqli_num_rows($result) == 0) {
				echo 'No categories found in the database.';
			} else {
				echo '
					<table>
					<h3>Latest topics in categories</h3>
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

				echo '</table>';
			}
		}
	?>
</div>
<div id="sampleTxt">
	<h3>This is a sample page</h3>
	<p>This page was created for demonstrating forum pages made by Chaost.</p><br>
	<p>SampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSampleSample</p>
</div>

<?php 

	include 'footer.php';

?>