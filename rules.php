<head>

	<style>

		#rulesHeader {
			background-color: #cc0000;
			height: 30px;
			text-align: center;
			color: white;
		}

		#rulesHeader h2 {
			padding: 2px;
		}

		.fail {
			margin: auto;
			color: red;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '<div id="rulesHeader"><h2>Rules</h2></div>';

	$sql = 'SELECT * FROM rules';
	$result = mysqli_query($conn, $sql);

	if (!$result) {
		echo '<p class="fail">Failed to retrieve rules.</p>';
	} else {
		echo '
		<div id="rules">
			<ul>
		';
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<li class="rule"><p>' . $row['rule_content'] . '</p></li>';
		}
		echo '
			</ul>
		</div>
		';
	}

	include 'footer.php';

?>