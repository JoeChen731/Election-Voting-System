<?php
	session_name("login");
	session_start();
	include "../Server/BusinessLayer.php";
	include "../Server/PresentationLayer.php";

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Modify</title>
        <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        #login-info {
            color: #666;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        a {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        a:hover, button:hover {
            background-color: #3E8E41;
        }
        </style>
    </head>
    <body>
	<?php
		if(isset($_SESSION['loggedIn']))
		{
			if($_SESSION['loggedIn'] == true)
			{
                $db = new BusinessLayer();
                $id=$_GET['SocietyID'][0];
                $societyName = $db->getSocietyByID($id);
				echo "You are logged in as ".$_SESSION['user_name']."<br>";
                echo "Society: ".$societyName."<br>";
                echo "<a href='Modify.php?type=electionActive&action=view&SocietyID=".$id."'>View Active Elections</a><br>";
                echo "<a href='Modify.php?type=electionCompleted&action=view&SocietyID=".$id."'>View Completed Elections</a><br>";
                echo "<a href='Modify.php?type=election&action=add&society=".$id."'>Create New Election</a><br>";

            }
        }    
        else
        {
            header("Location: Login.php?invalid=true");
            exit();
        }    
        
?>
<br/>
<br/>
<a href = "Admin.php">View All Societies</a><br/>
<a href = "logout.php">Logout</a>
</body>
</html>
