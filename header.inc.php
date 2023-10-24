<?php
	session_name("login");
	session_start();
	include "BusinessLayer.php"; 
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Events</title>
    </head>
    <body>
	<?php
		if(isset($_SESSION['loggedIn']))
		{
			if($_SESSION['loggedIn'] == true)
			{