<?php
include "../Server/BusinessLayer.php"; 
session_name("login");
session_start();

    if(!empty($_SESSION['loggedIn']))
    {
        header("Location: Admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if (isset($_POST['submit']))
        {

            if(isset($_POST['userName']) && isset($_POST['password']))  
            {   
                $bl = new BusinessLayer();
                $userName = $bl->validate($_POST['userName']);
                $pass = $bl->validate($_POST['password']);
                $login = $bl->validateLogin($userName,$pass);
                if($login == 1)
                {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['user_name'] = $bl->getEmpNameAtLogin($userName,1);
                    $_SESSION['user_level'] = $login;
                    //header("Location: Admin.php");
                }
                if($login == 2)
                {
                    $voterData = $bl->getVoterData($userName,2);
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['user_name'] = $voterData[0]["Name"];
                    $_SESSION['society'] = $bl->getSocietyByID($voterData[0]["Society_id"]);
                    $_SESSION['user_level'] = $login;
                    header("Location: voter_Homepage.php?SocietyID=".$voterData[0]["Society_id"]);
                }
                else { header("Location: Login.php".$test);}
            }
            elseif (isset($_GET['invalid']))//user tries to access admin page without logging in 
            {
                if($_GET['invalid'] == true)
                {
                    echo "<h1>You need to enter Credentials!</h1>";
                }
            }
        }
        //else{ echo "<h1>You need to login first!</h1>"; };//
    ?>
    <form action ="Login.php" method="POST">
        <h2>Login</h2>
        <?php if(isset($_GET['error'])){ ?>
            <p class="error"> <?php echo $_GET['error'] ?></p>
        <?php }?>
        <div>
            <label for="userName">Username:</label>
            <input type="text" name="userName" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </div>
        <div>
            <input type="submit" name="submit" value="Login" />
        </div>
        <div>
            <p>Need an account? <span class="signup-link"><a href="Signup.php">Sign Up</a></span></p>
        </div>
        <div>
            <a href="ForgotPassword.php"><p>Forgot password?</p></a>
        </div>
    </form>
    
</body>
</html>
