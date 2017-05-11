<head>

	<style>

		#rulesHeader {
			background-color: #cc0000;
			width: 95%;
			height: 80px;
			text-align: center;
			color: white;
		}

		.fail {
			margin: auto;
			color: red;
		}

		#rules {
			text-align: center;
			margin: auto;
		}


	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	echo '<div id="rulesHeader"><h2>Rules</h2></div>';

	$sql = 'SELECT * FROM rules';
	$result = mysqli_connect($conn, $sql);

	if (!$result) {
		echo '<p class="fail">Failed to retrieve rules.</p>';
	} else {
		echo '
		<div id="rules">
			<ul>
		';
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<li class="rule"><h5>' . $row['rule_content'] . '</h5></li>';
		}
		echo '
			</ul>
		</div>
		';
	}

	include 'footer.php';

?>