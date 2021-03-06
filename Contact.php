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
    <title>Mini Game Hub: Contact</title>
</head>
<body>
<div class="logo_bg_small">
    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

    <h1 class="logo_text" > Contact </h1>

    <a class="logo_text" href="MiniGameHubMenu.php"> Menu </a>

</div>
<div style="margin-left: 25%">
    <h1> Creators: </h1>
    <ul id="horizontal-list">
        <li> Hubert Ruczyński:
            <ul >
                <li> Email: hruczynski21@interia.pl </li>
                <li> GitHub: <a href="https://github.com/HubertR21"> Huberts GitHub </a> </li>
                <li> Linkedin: <a href="https://www.linkedin.com/in/hubert-ruczy%C5%84ski-95518b218"> Huberts Linkedin </a> </li>
            </ul>
        </li>
        <li> Szymon Rećko:
            <ul >
                <li> Email: szymonrecko1@gmail.com </li>
                <li> GitHub: </li>
                <li> Linkedin: </li>
            </ul>
        </li>
    </ul>

    <h1> GitHub Repository: </h1>
    <a href="https://github.com/HubertR21/Mini_Game_Hub"> Project Repository </a> </li>
</div>



</body>
</html>