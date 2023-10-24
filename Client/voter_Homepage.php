<?php
	//session_name("login");
	//session_start();
	include "../Server/BusinessLayer.php"; 
	include "../Server/PresentationLayer.php"; 
	$title = "Election";
	require_once( "../header.inc.php" );
?>
<style>
	body {
		font-family: Arial, sans-serif;
	}
	
	h1 {
		text-align: center;
		margin-top: 50px;
	}
	
	.logged-in-as {
		font-weight: bold;
		margin-top: 30px;
	}
	
	.active-elections {
		margin-top: 30px;
	}
	
	table {
		border-collapse: collapse;
		width: 100%;
	}
	
	th, td {
		text-align: left;
		padding: 8px;
	}
	
	th {
		background-color: #0099ff;
		color: white;
	}
	
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	
	a {
		display: block;
		text-align: center;
		margin-top: 50px;
	}
</style>
<?php
			$bl = new BusinessLayer();
			$pl = new PresentationLayer();
			echo "<h1>You are logged in as ".$_SESSION['user_name']."</h1>";
			//echo "<div class='logged-in-as'>You are logged in as ".$_SESSION['user_name']."</div>";
			//echo "<br>".var_dump($_SESSION)."<br>";
			if($_SESSION['user_level'] = 2)
			{
				//echo "Buttons go here<br><br>";
				//echo "<a href='elections.php?SocietyID=".$_SESSION['society']."'>View Recent Elections</a><br>";
				echo "<div class='active-elections'>";
				echo "<h2>Your Active Elections</h2>";
				echo $_SESSION['society']."<br>";
				echo $pl->getActiveElectionsAsTable($_GET['SocietyID']);
				echo "</div>";
			}
	?>
	<a href = "logout.php">Logout</a>
	</body>
</html>
