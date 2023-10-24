<?php
	session_name("login");
	session_start();
	include "BusinessLayer.php"; 

	if(isset($_GET['deleteID']))
	{	
		$db = new BusinessLayer();
		switch ($_GET['type']) 
		{
			case "event":
				$db->removeAttendeeFromEvent($db->getAttendeeIDByName($_SESSION['user_name']),$_GET['deleteID']);
				break;
			case "session":
				$db->removeAttendeeFromSession($db->getAttendeeIDByName($_SESSION['user_name']),$_GET['deleteID']);
				break;
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Events</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #3e8e41;
        }
        p.error {
            color: red;
        }
    </style>
<head>
    <body>
	<?php
		if(isset($_SESSION['loggedIn']))
		{
			if($_SESSION['loggedIn'] == true)
			{
                $db = new BusinessLayer();
				echo "You are logged in as ".$_SESSION['user_name'];
				echo "</br>";
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
				echo "Your Events";
				echo "</br>";
				echo $db->prepareEventsbyIDasTable($_SESSION['user_name']);
				echo "</br>";
				echo "Your Sessions";
				echo "</br>";
				echo $db->prepareSessionsbyIDasTable($_SESSION['user_name']);
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