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
    <title>Mini Game Hub: Tic Tac Toe</title>
</head>
<body>
    <div class="logo_bg_small">
        <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
        <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

        <h1 class="logo_text" >
        <?php
            if ($LOGGED_IN == true){
                echo 'Multiplayer TicTacToe, ' ;
                echo 'User: '.$_SESSION['username']. '';
                }else{
                echo 'Unable to connect ';
                }
        ?>
        </h1>

        <a class="logo_text" href="MiniGameHubMenu.php"> Menu </a>
        <a href="CheckTurn.php"> CheckTurn.php </a> <br>
        <a href="InitialInfo.php"> InitialInfo.php </a> <br>

    </div>
    <section>
        <div class="game--container">
            <div data-cell-index="0" class="cell"></div>
            <div data-cell-index="1" class="cell"></div>
            <div data-cell-index="2" class="cell"></div>
            <div data-cell-index="3" class="cell"></div>
            <div data-cell-index="4" class="cell"></div>
            <div data-cell-index="5" class="cell"></div>
            <div data-cell-index="6" class="cell"></div>
            <div data-cell-index="7" class="cell"></div>
            <div data-cell-index="8" class="cell"></div>
        </div>
        <h2 class="game--status"></h2>
        <button class="game--restart">Restart Game</button>
        <a class="logo_text" href="TicTacToeCon.php" onclick="this.disabled=true"> Online Multiplayer </a>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="TicTacToe2.js"></script>

</body>
</html>