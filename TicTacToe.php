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
                echo 'TicTacToe, ' ;
                echo 'User: '.$_SESSION['username']. '';
                }else{
                echo 'TicTacToe ';
                }
        ?>
        </h1>

        <a class="logo_text" href="MiniGameHubMenu.php"> Menu </a>

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
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="TicTacToe.js"></script>
    <div class="insides">
        <script>
           function clickAndDisable(link) {
             // disable subsequent clicks
             link.onclick = function(event) {
                event.preventDefault();
             }
           }
        </script>
        <a class="logo_text" href="TicTacToeCon.php" onclick="clickAndDisable(this);"> Online Multiplayer </a>
        <h1> About the game </h1>
        <p>
            Tic-tac-toe (American English), noughts and crosses (Commonwealth English), or Xs and Os (Irish English) is a paper-and-pencil game for two players who take turns marking the spaces in a three-by-three grid with X or O. The player who succeeds in placing three of their marks in a horizontal, vertical, or diagonal row is the winner.
        </p>
    </div>



</body>
</html>