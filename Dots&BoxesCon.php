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
        echo 'Connecting Dots and Boxes, ' ;
        echo 'User: '.$_SESSION['username']. '';
        }else{
        echo 'Unable to connect ';
        }
    ?>
    </h1>


    <a class="logo_text" href="Dots&Boxes.php"> Go Offline </a>

</div>

</body>
</html>