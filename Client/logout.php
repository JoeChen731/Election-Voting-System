<?php
    session_name("login");
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_level']);
    session_destroy();
    
    header("Location: Login.php");
?>