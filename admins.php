<head>

	<style>

		body {
			text-align: center;
		}

		table, th, td {
			border: 1px solid white;
		}

		table {
			border-collapse: collapse;
			margin: auto;
			color: white;
			background-color: #cc0000;
			margin-top: 25px;
		}

		td {
			padding: 12px 16px;
			text-align: center;
		}

		th {
			text-align: center;
			padding: 12px;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	$sql = 'SELECT user_name, user_email FROM users WHERE user_level=1';

	$result = mysqli_query($conn, $sql);

	if (!$result) {
		echo 'Failed to retrieve admin names, please contact your web developer.';
	} else {

		echo '
			<h2 id="header">All Admins</h2>
			<div id="adminInfCont">
				<table>
					<tr>
					<th><h3>Name</h3></th>
					<th><h3>Send E-mail</h3></th>
					</tr>';

					while ($row = mysqli_fetch_assoc($result)) {
						echo '
							<tr>
								<td class="rightPart"><h4 class="name">' . $row['user_name'] . '</h4></td>
								<td class="leftPart"><p>' . $row['user_email'] . '</p></td>
							</tr>
						';
					}

			echo '</table>
			</div>';

	}

	include 'footer.php';

?>