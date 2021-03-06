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
    <title>Mini Game Hub: Dots and Boxes</title>
</head>
<body>
<div class="logo_bg_small">
    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

    <h1 class="logo_text" >
    <?php
    if ($LOGGED_IN == true){
        echo 'Dots and Boxes, ' ;
        echo 'User: '.$_SESSION['username']. '';
        }else{
        echo 'Dots and Boxes ';
        }
    ?>
    </h1>


    <a class="logo_text" href="MiniGameHubMenu.php"> Menu </a>

</div>

<div class="insides">
    <div class="controls">
        <label>Grid Size
            <input type="range" min="5", max="10" value="7" id="gridSize" />
        </label>

        <div class="player">
            <span class="player-num">Player 1</span>
            <input type="color" value="#ff6666" id="p1Colour" />
            <span class="score" id="p1Score">0</span>
            <div class="turn" id="turn">&#9679;</div>
        </div>

        <div class="player">
            <span class="player-num">Player 2</span>
            <input type="color" value="#3CB371" id="p2Colour" />
            <span class="score" id="p2Score">0</span>
        </div>
    </div>

    <div class="play-area">
        <canvas>Canvas not supported by browser</canvas>
    </div>

    <script src="./Dots&Boxes.js"></script>

    <a class="logo_text" href="Dots&BoxesCon.php" disabled="disabled"> Coming Soon: Online Multiplayer </a>

    <h1> About the game </h1>
    <p>
        Dots and Boxes is a pencil-and-paper game for two players. It was first published in the 19th century by French mathematician Édouard Lucas, who called it la pipopipette. It has gone by many other names, including the dots and dashes, game of dots, dot to dot grid, boxes, and pigs in a pen.
        <br>
        The game starts with an empty grid of dots. Usually two players take turns adding a single horizontal or vertical line between two unjoined adjacent dots. A player who completes the fourth side of a 1×1 box earns one point and takes another turn. A point is typically recorded by placing a mark that identifies the player in the box, such as an initial. The game ends when no more lines can be placed. The winner is the player with the most points. The board may be of any size grid. When short on time, or to learn the game, a 2×2 board (3×3 dots) is suitable. A 5×5 board, on the other hand, is good for experts.
    </p>
</div>



</body>
</html>