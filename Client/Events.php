<?php
	$title = "Election";
	require_once( "includes/header.inc.php" );

				$db = new BusinessLayer();
				echo "You are logged in as ".$_SESSION['user_name'];
				echo "</br>";
				echo "<br>".var_dump($_SESSION)."<br>";
				if($_SESSION['user_level'] <= 2)
				{
					echo "<h2><a href='Admin.php'> Admin </a></h2>
					<h2><a href='Events.php'> Events </a></h2>
					<h2><a href='Registrations.php'> Registrations </a></h2><br/>";
				}
				else
				{
					echo "<h2><a href='Events.php'> Events </a></h2>
					<h2><a href='Registrations.php'> Registrations </a></h2><br/>";
				}
				echo "Events";
				echo $db->prepareEventsAsTable(false);
				echo "</br>";
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