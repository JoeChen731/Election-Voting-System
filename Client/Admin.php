<?php
	session_name("login");
	session_start();
	include "../Server/BusinessLayer.php"; 
	include "../Server/PresentationLayer.php"; 

	
	if(isset($_GET['deleteID']))
	{	
		$bl = new BusinessLayer();
		switch($_GET['type']) 
		{
			case "society":
				$bl->deleteSocietyByID($_GET['deleteID']);
				break;
		}
		unset($_POST);
    	header("Location: ".$_SERVER['PHP_SELF']);
	}	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<style>
			body {
    			font-family: Arial, sans-serif;
			}

			h2 {
    			font-size: 24px;
    			font-weight: bold;
			}

			a {
				text-decoration: none;
				color: #333;
				font-weight: bold;
			}

			a:hover {
				color: #666;
			}

			table {
				border-collapse: collapse;
				width: 100%;
			}

			th,td {
				padding: 8px;
				text-align: left;
				border-bottom: 1px solid #ddd;
			}

			th {
				background-color: #f2f2f2;
				font-weight: bold;
			}
		</style>	
    	<title>Admin</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	<?php
		if(isset($_SESSION['loggedIn']))
		{
			if($_SESSION['loggedIn'] == true)
			{
				$bl = new BusinessLayer();
				$pl = new PresentationLayer();

				echo "You are logged in as ".$_SESSION['user_name'];
				echo "</br>";
				echo "You can view: <br>";
				if($_SESSION['user_level'] == 1)
				{
					echo "Societies";
					echo "</br>";
					echo $pl->getSocietiesAsTable();
				}
			}
		}
		else
		{
			header("Location: Login.php?invalid=true");
			exit();
		}
	?>
	<a href = "logout.php">Logout</a>
	</body>
</html>

<!--
<?php
	$title = "Election";
	require_once( "../header.inc.php" );
	
	if(isset($_GET['deleteID']))
	{	
		$bl = new BusinessLayer();
		switch($_GET['type']) 
		{
			case "society":
				$bl->deleteSocietyByID($_GET['deleteID']);
				break;
		}
		unset($_POST);
    	header("Location: ".$_SERVER['PHP_SELF']);
	}
		
?> -->