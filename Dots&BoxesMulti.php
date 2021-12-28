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
        echo 'Multiplayer Dots and Boxes, ' ;
        echo 'User: '.$_SESSION['username']. '';
        }else{
        echo 'Unable to connect ';
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
</div>



</body>
</html>