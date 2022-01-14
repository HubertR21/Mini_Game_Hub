<?php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Mini Game Hub - Perfect for lectures!</title>

    <style type="text/css"> </style>
</head>
<body>
    <div class="logo_bg">
        <img class="logo" src="./images/Logo.png" alt="Mini Game Hub" width="35%" height="35%">
    </div>
    <div class="insides">
        <a class="login" href="logout.php">
        <?php
            if ($LOGGED_IN == true){
                echo 'Log Out';
                }else{
                echo 'Log In';
                }
        ?>
        </a>
        <br>
        <a class="login" href="register.php">
        <?php
            if ($LOGGED_IN == true){
                echo 'Current Account: '.$_SESSION['username']. ' Click to create a new one';
                }else{
                echo 'Register';
                }
        ?>
        </a>
        <h1> Available Games: </h1>
        <a href="Dots&Boxes.php"> Dots and Boxes </a> <br>
        <a href="TicTacToe.php"> Tic Tac Toe </a>

        <h1> Coming Soon: </h1>
        <a href="ManDontGetAngry.php"> Man, Dont Get Angry </a>

        <p class="bottom_ref">
            <a href="Contact.php">CONTACT</a>
        </p>
    </div>
</body>
</html>