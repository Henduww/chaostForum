<head>

	<style>

		#topicHeader {
			background-color: #cc0000;
			width: 100%;
			color: white;
			height: 40px;
			text-align: center;
		}

		.topicHName {
			padding: 6px;
		}

		#mainPost {
			border: 1px solid lightgray;
			width: 100%;
			height: 250px;
			margin-top: 20px;
		}

		#OP {
			width: 200px;
			background-color: #cc0000;
			border-right: 1px solid lightgray;
			display: inline;
			float: left;
			height: 100%;
			text-align: center;
			color: white;
		}

		#OPName {
			padding: 15px;
			border-bottom: 1px solid lightgray;
		}

		.usrType {
			border-top: 1px solid lightgray;
			padding: 15px;
			margin-top: 65px;
		}

		#postDate {
			margin-top: 70px;
		}

		#postContent {
			width: 605px;
			height: 225px;
			display: inline-block;
			margin: 14px;
			background-color: rgb(239, 239, 239);
		}

		#conts {
			padding: 15px;
		}

		textarea {
			width: 320px;
			height: 105px;
			resize: none;
		}

		#submitReply {
			background-color: #cc0000;
			padding: 5px;
			color: white;
		}

		#topPostReply {
			margin: 20px;
		}

		#noReplies {
			margin: auto;
			padding-top: 30px;
			padding-bottom: 30px;
		}

		#replies {
			display: flex;
			flex-flow: row wrap;
		}

		.reply {
			background-color: rgb(239, 239, 239);
			width: 80%;
			margin-left: 75px;
			margin-bottom: 17.5px;
			margin-top: 17.5px;
			border: 1px solid #cc0000;
			position: relative;
			border-radius: 10px;
		}

		.replier {
			width: 150px;
			background-color: #cc0000;
			border: 0px solid white;
			display: inline;
			color: white;
			float: left;
			text-align: center;
			position: absolute;
			bottom: 0;
			top: 0;
			border-top-left-radius: 10px;
			border-bottom-left-radius: 10px;
		}

		.repInf {
			padding: 5px;
		}

		.replyCont {
			padding: 15px;
			word-wrap: break-word;
			margin-left: 150px;
		}

	</style>

</head>

<?php

	include 'connect.php';
	include 'header.php';

	if (!isset($_GET['id'])) {
		echo 'No topic chosen, please try again.';
	} elseif ($_GET['id'] == "") {
		echo 'INVALID. Please leave the page and choose another topic.';
	} else {
		$sql = 'SELECT topic_id, topic_subject FROM topics WHERE topic_id=' . mysqli_real_escape_string($conn, $_GET['id']);

		$result = mysqli_query($conn, $sql);

		if (!$result) {
			echo 'Could not retrieve this topic. Error: ' . mysqli_error($conn);
		} else {
			echo '<div id="topicHeader">';
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<h2 class="topicHName">' . $row['topic_subject'] . '</h2>';
				}
			echo '</div>';

			$sql = 'SELECT posts.post_topic, posts.post_content, posts.post_date, posts.post_by, posts.post_id, users.user_id, users.user_name, users.user_level FROM posts LEFT JOIN users ON posts.post_by = users.user_name WHERE posts.post_topic=' . mysqli_real_escape_string($conn, $_GET['id']);

			$result = mysqli_query($conn, $sql);

			if (!$result) {
				echo 'Could not retrieve the post! Error: ' . mysqli_error($conn);
			} else {
				echo '
					<div id="mainPost">
						<div id="OP">';
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<b><p id="OPName">' . $row['post_by'] . '</p></b>';
								echo '<p id="postDate"><b>' . date('d-m-y', strtotime($row['post_date'])) . '</b></p>';
								$usrLvl = $row['user_level'];
								$postCont = $row['post_content'];
							}
				echo '<p class="usrType"><i class="material-icons" style="font-size:14px">person</i><b><span> ';
							if ($usrLvl == 1) {
								echo 'Admin';
							} else {
								echo 'Regular User';
							}
							echo '
							</span></b></p>
						</div>
						<div id="postContent">
								<p id="conts">' . $postCont . '</p>
						</div>
					</div>

					<div id="replies">';
						$sql = 'SELECT reply_content, reply_date, reply_by FROM reply WHERE reply_topic=' . $_GET['id'];
						$result = mysqli_query($conn, $sql);

						if (!$result) {
							echo 'Failed to retrieve replies.';
						} else {
							if (mysqli_num_rows($result) == 0) {
								echo '<p id="noReplies"><b>There are no replies posted yet.</b></p>';
							} else {
								while ($row = mysqli_fetch_assoc($result)) {
									echo '
									<div class="reply">
										<div class="replier"><p class="repInf"><b>' . $row['reply_by'] . '</b><br>' . $row['reply_date'] . '</p>
										</div>
										<div class="replyCont">' . $row['reply_content'] . '</div>
									</div>
									';
								}
							}
						}

					echo '
					</div>

					<div id="topPostReply">';
						if (!isset($_SESSION['signedIn'])) {
							echo 'You have to be signed in to post a reply.';
						} else {
						echo '
						<form method="post" action="reply.php?id=' . $_GET['id'] . '">
							<textarea placeholder="Reply to this topic.." type="text" name="message"></textarea><br><br>
							<input id="submitReply" type="submit" value="Submit Reply" />
						</form>
						';
						}
					echo '
					</div>
				';
			}


		}
	}

	include 'footer.php';

?>