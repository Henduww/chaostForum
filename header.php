<?php

	session_start();

	if (isset($_GET['logout'])) {
		session_destroy();
		header("Location: index");
	}

?>

<!DOCTYPE html>

<html lang="en">
	
	<head>

		<link rel="icon" href="c.jpg"/>
		<meta charset="UTF-8"/>
		<meta name="description" content="A forum, purely for practicing the back-end development of one."/>
		<meta name="keywords" content="key, words"/>
		<title>A Forum</title>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<style>

			body {
				margin: 0px;
				padding: 0px;
				font: 14px arial;
				background-color: #f2f2f2;
			}

			p, h2, span {
				margin: 0px;
				padding: 0px;
			}

			#content {
				width: 835px;
				background-color: white;
				box-shadow: 0px 1px 20px 3px rgba(0, 0, 0, 0.2);
				margin: auto;
				padding: 5px;
				margin-top: 26px;
				padding-bottom: 55px;
				padding-top: 35px;
			}

			#userbar {
				height: 30px;
				width: 100%;
				background-color: black;
				color: white;
			}

			a.signIn:link, a.signIn:visited, a.register:link, a.register:visited, a.logout:link, a.logout:visited {
				float: right;
				margin: 0px;
				padding: 6px 15px;
				background-color: black;
				text-align: center;
				text-decoration: none;
				color: white;
			}

			a.signIn:hover, a.register:hover, a.logout:hover {
				background-color: #3B3B3B;
			}

			a.sessName:link, a.sessName:visited {
				text-decoration: none;
				color: white;
			}

			a.sessName:hover {
				color: lightgray;
			}

			#sessName {
				display: inline;
				margin: 0px;
				padding: 0px;
				color: white;
			}

			#menu {
				width: 700px;
				height: 50px;
				background-color: #cc0000;
				border: 0px;
				border-bottom-left-radius: 15px;
				float: right;
				box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.2);
			}

			#menu a:link, #menu a:visited {
				text-decoration: none;
				color: white;
				background-color: #cc0000;
				padding: 16px;
				float: right;
				margin-left: 1px;
			}

			#menu a:hover, #menu a:active {
				background-color: #e60000;
			}

			#topBar {
				height: 50px;
				background-color: white;
				width: 100%;
				float: right;
				display: inline;
				box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, 0.17);
			}

			#navBarTxt {
				padding: 15px;
				color: white;
				display: inline-block;
				border-right: 1px solid white;
			}

			#footer {
				position: fixed;
				bottom: 0;
				width: 100%;
				color: white;
				background-color: black;
				text-align: center;
			}

			#userPanel {
				padding: 6px 15px;
				float: left;
				border-right: 1px solid lightgray;
			}

			#logo {
				display: inline;
				margin: 50px;
				margin-top: 12px;
				float: left;
			}

			#welcome {
				padding: 6px 15px;
				float: right;
			}

		    #drpdownBtn {
		    	color: white;
		    	cursor: pointer;
		    	text-decoration: none;
		    }

		    .fa {
		    	padding: 5px;
		    }

		    .dropdown {
		    	position: relative;
		    	display: inline-block;
		    }

		    .drpdownCont {
		    	display: none;
		    	position: absolute;
		    	background-color: black;
		    	min-width: 160px;
		    	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		    	z-index: 1;
		    }

		    .drpdownCont a {
		    	color: white;
		    	padding: 12px 16px;
		    	text-decoration: none;
		    	display: block;
		    }

		    .drpdownCont a:hover {
		    	background-color: white;
		    	color: black;
		    }

		    .dropdown:hover .drpdownCont {
		    	display: block;
		    }

		    #admin {
		    	font-size: 14px;
		    	padding: 12px 16px;
		    	border-bottom: 1px solid gray;
		    }

		</style>

	</head>

	<body>

		
		<div id="userbar">
			<span id="userPanel">User Panel</span>
			<?php
				if ($_SESSION['userlvl'] == '1') {
					echo '
						<div class="dropdown">
		        			<a href="#" id="drpdownBtn"><i class="fa fa-angle-right" style="font-size:16px"></i>Admin Panel</a>
			        	    <div class="drpdownCont">
			        	    	<p id="admin">Admin Panel</p>
			        	        <a href="create_cat">Create category</a>
			        	        <a href="promote">Promote to admin</a>
			        	        <a href="addrule">Add rules</a>
			        	    </div>
		        		</div>
		        	';
        		}

				if (isset($_SESSION['signedIn'])) {
					echo '
						<a href="#" class="logout">Sign Out</a>
						<span id="welcome">
							Hello, <b><a href="#" class="sessName">' . $_SESSION["username"] . '
						</b></a></span>
					';
				} else {
					echo '
						<a href="signin" class="signIn">Sign In</a>
						<a href="signup" class="register">Register</a>
					';
				}
			?>
		</div>
		<div id="topBar">
			<div id="menu">
	        	<b><p id="navBarTxt">Navigation Bar</p></b>
				<a class="navLink" href="rules">Rules</a>
				<a class="navLink" href="#">News</a>
				<a class="navLink" href="admins">Mods/Admins</a>
				<a class="navLink" href="category">Categories</a>
				<a class="navLink" href="create_top">Create a topic</a>
				<a class="navLink" href="index">Home</a>
			</div>
			<h2 id="logo">Chaost Forum</h2>
		</div>

		<div id="wrapper">
			<div id="content">