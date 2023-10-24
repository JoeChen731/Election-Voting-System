<?php
    include "../Server/BusinessLayer.php"; 
    session_name("signup");
?>

<?php
if (isset($_POST['submit']))
{

    if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['confirmPassword']))  
    {   
        $bl = new BusinessLayer();
        $userName = $bl->validate($_POST['userName']);
        $pass = $bl->validate($_POST['password']);
        $confirmPass = $bl->validate($_POST['confirmPassword']);
        $societyID = $bl->validate($_POST['societyID']);

        // Check if the password and confirm password fields match
        if($pass != $confirmPass) {
            header("Location: Signup.php?error=Passwords do not match!");
            exit;
        }

        // Check if the username already exists in the database
        if($bl->userExists($userName)) {
            header("Location: Signup.php?error=Username already exists!");
            exit;
        }

        // Add the new user to the database
        $data = $bl->insertVoter($userName, $pass, $societyID);
        // start or restart session here
        if($data == 1)
        {
            $voterData = $bl->getVoterData($userName,2);
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_name'] = $userName;
            $_SESSION['society'] = $bl->getSocietyByID($voterData[0]["Society_id"]);
            $_SESSION['user_level'] = $data+1;
            header("Location: voter_Homepage.php?SocietyID=".$voterData[0]["Society_id"]);
        }
        else
        {
            echo $data;
        }
    }
}
?>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    <form action ="Signup.php" method="POST">
        <h2>Sign Up</h2>
        <?php if(isset($_GET['error'])){ ?>
            <p> <?php echo $_GET['error'] ?></p>
        <?php }?>
        <div>
            <label for="userName">Username:</label>
            <input type="text" name="userName" size="30" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" size="30" />
        </div>
        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" size="30" />
        </div>
        <div>
            <label for="societyID">Enter Society Code:</label>
            <input type="text" name="societyID" size="30" />
        </div>
        <div>
            <input type="submit" name="submit" value="Sign Up" />
        </div>
        <div>
            <p>Already have an account? <span class="login-link"><a href="Login.php">Login</a></span></p>
        </div>
    </form>
    </body>
</html>