<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Election Candidates</title>
	<style>
		body {
			background-color: #f5f5f5;
			font-family: Arial, sans-serif;
		}

		h1 {
			text-align: center;
			margin-top: 30px;
		}

		table {
			border-collapse: collapse;
			margin: 30px auto;
			width: 80%;
			background-color: #fff;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 10px;
			border: 1px solid #ccc;
		}

		th {
			background-color: #f2f2f2;
			color: #333;
		}

		tr:hover {
			background-color: #f5f5f5;
		}

		button {
			background-color: #008CBA;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		button:hover {
			background-color: #006F8C;
		}

		a {
			color: #008CBA;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<h1>Election Candidates</h1>

	<?php
	session_name("login");
	session_start();
	include "../Server/BusinessLayer.php";
	include "../Server/PresentationLayer.php";

	if(isset($_POST['submit'])) {
		if($_SESSION['user_level'] == 2) {
			$bl = new BusinessLayer();
			header("Location: voter_Homepage.php?SocietyID=".$_GET['SocietyID']);
		}
	}

	if(isset($_SESSION['loggedIn'])) {
		if($_SESSION['loggedIn'] == true) {
			$db = new BusinessLayer();
			$pl = new PresentationLayer();
			echo "<p>You are logged in as ".$_SESSION['user_name']."</p>";
			echo $pl->getElectionCandidatesTable($_GET['SocietyID']);
			echo '<button onclick="goBack()">Back</button>';
			echo '<script>function goBack() {window.history.back();}</script>';
		}
	} else {
		header("Location: Login.php?invalid=true");
		exit();
	}
	?>

</body>
</html>
