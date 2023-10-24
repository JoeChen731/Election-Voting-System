<!DOCTYPE HTML>
<html>
    <head>
        <title>Modify</title>
		<style>
			body {
				background-color: #f0f0f0;
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
			}

			h1 {
				color: #333;
				font-size: 24px;
				margin-bottom: 20px;
			}

			a {
				color: #666;
				font-size: 16px;
				text-decoration: none;
				display: inline-block;
				padding: 10px 20px;
				border-radius: 5px;
				background-color: #ccc;
				margin-right: 10px;
			}

			a:hover {
				background-color: #aaa;
				color: #fff;
			}

			input[type="text"],
			input[type="password"],
			input[type="date"] {
				padding: 10px;
				font-size: 16px;
				border-radius: 5px;
				border: 1px solid #ccc;
				width: 100%;
				box-sizing: border-box;
				margin-bottom: 10px;
			}

			label {
				font-size: 16px;
				font-weight: bold;
				display: block;
				margin-bottom: 5px;
			}

			select {
				padding: 10px;
				font-size: 16px;
				border-radius: 5px;
				border: 1px solid #ccc;
				width: 100%;
				box-sizing: border-box;
				margin-bottom: 10px;
			}

			button[type="submit"] {
				background-color: #4CAF50;
				color: #fff;
				padding: 10px 20px;
				border: none;
				border-radius: 5px;
				font-size: 16px;
				cursor: pointer;
				margin-top: 10px;
			}

			button[type="submit"]:hover {
				background-color: #3e8e41;
			}

			.error-message {
				color: #ff0000;
				font-size: 14px;
				margin-bottom: 10px;
			}

		</style>
    </head>
    <body>
    <?php
        session_name("login");
        session_start();
        include "../Server/BusinessLayer.php";
        include "../Server/PresentationLayer.php";

        if(isset($_POST['submit']))
        {
            $message = 1;
            $bl = new BusinessLayer();
            if($_SESSION['user_level'] == 1)
            {
                if($_GET['action'] == 'add')
                {
                    switch ($_GET['type']) 
                    {
                        case "society":
                            $message = $bl->insertSociety($_POST['societyName'],$_POST['numPeople'],$_POST['contactPerson']);   
                            break;
                        case "election":
                            $message = $bl->insertElection($_POST['societyID'],$_POST['electionName'],$_POST['startDate'],$_POST['endDate'],$_POST['instruction'],$_POST['candidateA'],$_POST['candidateB']);
                            break;
                    }
                }

                if($message == 1)
                {
                    switch($_GET['type'])
                    {
                        case 'society':
                            header("Location: Admin.php");
                            break;
                        case 'election':
                            $id=$_POST['societyID'];
                            unset($_POST);
                            header("Location: Society.php?SocietyID=".$id);
                            break;
                    }
                    
                }
                else
                {
                    echo $message;
                }   
        	}
		}
    ?>
        <div class="wrapper">
            <?php
                if(isset($_SESSION['loggedIn']))
                {
                    if($_SESSION['loggedIn'] == true)
                    {
                        $bl = new BusinessLayer();
                        $pl = new PresentationLayer();
                        echo "<p>You are logged in as ".$_SESSION['user_name']."</p>";
                        echo "<br/>";
                        if($_SESSION['user_level'] == 1)
                        {
                            if(isset($_GET['action']))
                            {
                                if($_GET['action'] == "view")
                                {
                                    switch ($_GET['type']) 
                                    {
                                        case "electionActive":
                                            echo $pl->getActiveElectionsAdmin($_GET['SocietyID']);
                                            break;
                                        case "electionCompleted":
                                            echo $pl->getCompletedElectionsAdmin($_GET['SocietyID']);
                                            break;
                                    }
                                }
                                else if($_GET['action'] == "add")
                                {
                                    switch ($_GET['type']) 
                                    {
                                        case "society":
                                            echo $pl->addSocietyTable();
                                            break;
                                        case "election":
                                            echo $pl->createElectionTable();
                                    }
                                }   
                                
                            }
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
        </div>
    </body>
</html>