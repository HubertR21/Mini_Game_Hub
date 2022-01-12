<?php
//pobiera wstępne informacji ktory gracz  jest któy i czyja tura
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //getting all records for us and our enemy
    echo $_SESSION['userid'];
?>